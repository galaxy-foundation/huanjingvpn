function fallbackCopyTextToClipboard(text) {
	var textArea = document.createElement("textarea");
	textArea.value = text;
	document.body.appendChild(textArea);
	textArea.focus();
	textArea.select();

	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful';
		console.log('Fallback: Copying text command was ' + msg);
	} catch (err) {
		console.error('Fallback: Oops, unable to copy', err);
	}

	document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
	if (!navigator.clipboard) {
		fallbackCopyTextToClipboard(text);
		return;
	}
	navigator.clipboard.writeText(text).then(function() {
		$('.toast').toast('show');
		console.log('Async: Copying to clipboard was successful!');
	}, function(err) {
		console.error('Async: Could not copy text: ', err);
	});
}

const checkAddress={
	testnet: address=>{
		return new Promise(async resolve=>{
			try{
				let res=await request.get('https://test-insight.bitpay.com/api/addr/'+address).send();
				if(res.balanceSat+res.unconfirmedBalanceSat) {
					resolve('ok');
					return;
				}
				resolve('');
			}catch(e) {}
			try{
				let res=await request.get('https://api.blockcypher.com/v1/btc/test3/addrs/'+address).send();
				if(res.final_balance) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
		})
	},
	mainnet: address=>{
		return new Promise(async resolve=>{
			try{
				let res=await request.get('https://insight.bitpay.com/api/addr/'+address).send();
				if(res.balanceSat+res.unconfirmedBalanceSat) {
					resolve('ok');
					return;
				}
				resolve('');
			}catch(e) {}
			try{
				let res=await request.get('https://api.smartbit.com.au/v1/blockchain/address/'+address).send();
				if(res.address.total.balance_int) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
			try{
				let res=await request.get('https://blockchain.info/address/'+address+'?format=json').send();
				if(res.final_balance) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
			try{
				let res=await request.get('https://api.blockcypher.com/v1/btc/main/addrs/'+address).send();
				if(res.final_balance) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
			try{
				let res=await request.get('https://chain.so/api/v2/get_tx_received/BTC/'+address).send();
				if(res.data.txs.length || res.data.unconfirmed_txs.length) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
			try{
				let res=await request.get('https://chain.api.btc.com/v3/address/'+address).send();
				if(res.data.received || res.data.unconfirmed_received) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
			try{
				let res=await request.get('https://blockexplorer.com/api/txs/?address='+address).send();
				if(res.txs.length || res.unconfirmed_txs.length) {
					resolve('ok');
					return;
				}
				resolve('')
			}catch(e) {}
		})
	}
}

function checkTransaction(address,network='mainnet') {
	if(network=='testnet') return checkAddress.testnet(address);
	return checkAddress.mainnet(address);
}


$(document).ready(()=>{
	let address=$('#invoice-address-input').val();
	let amount=$('#invoice-amount-input').val();
	let text='bitcoin:'+address+'?amount='+amount;
	$("#invoice-qr-code").qrcode({render: 'image',ecLevel: 'M',size: 250,fill: '#000',text: text,radius: 0,quiet: 0,mode: 0});
	$("#copy-amount").click(()=>{
		copyTextToClipboard($('#invoice-amount-input').val())
	})
	$("#copy-address").click(()=>{
		copyTextToClipboard($('#invoice-address-input').val())
	})
	var counterdown=$('#payment-countdown');
	var iExpired=+new Date(counterdown.attr('expired'));
	var iNow=+new Date(counterdown.attr('now'));
	var iDiff=(+new Date())-iNow;
	var iCount=0;
	var realtime=()=>{
		var s=Math.floor((iExpired+iDiff-(+new Date()))/1000);
		if(s<0) {
			document.location="/client/invoice"
			return;
		}
		var h=Math.floor(s / 3600);
		s%=3600;
		var m=Math.floor(s / 60);
		s%=60;
		var progress=(100-s*100/43200);
		$('.progress-bar').css('width',progress+'%');
		$('#payment-countdown').html( (h>9?'':'0')+h+':'+(m>9?'':'0')+m+':'+(s>9?'':'0')+s )
		if(++iCount==5) {
			checkTransaction(address).then(res=>{
				if(res=='ok') {
					$.post( "/client/deposit/check",res=>{
						if(res.status=='ok') {
							
						}
						setTimeout(realtime,1000);
					})
				}else{
					setTimeout(realtime,1000);
				}
			});
			iCount=0;
		}else{
			setTimeout(realtime,1000);
		}
		

	};
	realtime()
})