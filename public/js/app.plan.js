(function(){
	var app={
		MONTHLY: 0,
		ANNUALLY: 1,
		BASIC: 0,
		PLUS: 1,
		PRO: 2,
		plan: 0,
		type: 1,
		coupon: '',
		render: async ()=> {
			/* 
			basic_old, basic_price, basic_saving
			plus_old, plus_price, plus_saving

			*/
			var data=JSON.parse($("#data").html());
			app.type=$('#plantype').prop('checked')?app.ANNUALLY:app.MONTHLY;
			if(app.type==app.MONTHLY) {
				$('#basic_old').html('-');
				$('#basic_price').html(data[0].price.toFixed(2));
				$('#basic_saving').html('-');

				$('#plus_old').html('-');
				$('#plus_price').html(data[2].price.toFixed(2));
				$('#plus_saving').html('-');
				
				$('#pro_old').html('-');
				$('#pro_price').html(data[4].price.toFixed(2));
				$('#pro_saving').html('-');

				if($("#monthly").hasClass('text-muted')) $("#monthly").removeClass('text-muted');
				if(!$("#monthly").hasClass('text-primary')) $("#monthly").addClass('text-primary');
				if(!$("#annually").hasClass('text-muted')) $("#annually").addClass('text-muted');
				if($("#annually").hasClass('text-primary')) $("#annually").removeClass('text-primary');
			}else{
				$('#basic_old').html("$"+data[0].price.toFixed(2));
				$('#basic_price').html((data[1].price/12).toFixed(2));

				$('#plus_old').html("$"+data[2].price.toFixed(2));
				$('#plus_price').html((data[3].price/12).toFixed(2));
				$('#plus_saving').html('-');
				
				$('#pro_old').html("$"+data[4].price.toFixed(2));
				$('#pro_price').html((data[5].price/12).toFixed(2));
				$('#pro_saving').html('-');

				if(!$("#monthly").hasClass('text-muted')) $("#monthly").addClass('text-muted');
				if($("#monthly").hasClass('text-primary')) $("#monthly").removeClass('text-primary');
				if($("#annually").hasClass('text-muted')) $("#annually").removeClass('text-muted');
				if(!$("#annually").hasClass('text-primary')) $("#annually").addClass('text-primary');
				
			}
			var val=data[app.plan*2+app.type].price;
			if(app.coupon) {
				$("#oldbilling").html("$"+val.toFixed(2));
				$("#billing").html("$"+(val-val*data['coupon']/100).toFixed(2));
			}else{
				$("#oldbilling").html("");
				$("#billing").html("$"+val.toFixed(2));
			}
		},
		validateCoupon: coupon=>{
			return new Promise((resolve,reject)=>{
				$.post( "/coupon",{coupon:coupon},res=>{
					resolve(res);
				});
			})
		}
	}
	$(document).ready(()=>{
		$('.pricing_item').on('click',function(){
			app.current.removeClass('active');
			app.current=$(this);
			app.plan=app.current.attr('data')*1;
			app.current.addClass('active');
			app.render();
		});
		app.current=$('.pricing_item.active');
		app.plan=app.current.attr('data')*1;
		$('#plantype').on('change',()=>{
			app.render();
		});
		$("#coupon").on('change',e=>{
			var val=e.currentTarget.value;

			if(val.length==10) {
				$('#coupon-check').removeClass('d-none');
				app.validateCoupon(val).then(res=>{
					if(res.status=='ok') {
						app.coupon=val;
					}else{
						app.coupon='';
						e.currentTarget.value="";
					}
					$('#coupon-check').addClass('d-none');
					app.render();
				});
			}else{
				app.coupon='';
				e.currentTarget.value="";
				app.render();
			}
		});
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#planning').click(()=>{
			$.post( "/plan",{plan:app.plan*2+app.type+1,coupon:app.coupon},res=>{
				if(res.status=='ok') {
					document.location="/register";
				}else{
					alert(res.messgae)
				}
			});
		});
	})
})();