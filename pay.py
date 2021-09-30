from bit import Key
import sys
cmd=sys.argv[1]
if cmd=='-p':
    privkey=sys.argv[2]
    leftover=sys.argv[3]
    target=sys.argv[4].split(',')
    ts=[]
    for x in target:
        v=x.split(':')
        ts.append((v[0],v[1],'btc'))
    print(Key(privkey).send(ts,leftover=leftover,fee=2,absolute_fee=False))