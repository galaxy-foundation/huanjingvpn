import psutil,time,os


class Cache:
    
    def get(self,key):
        return "a";
    
    def set(self,key,val):
        return;


class System:
    
    def GetSystem(self):
        cache_timeout = 86400
        networkIo = psutil.net_io_counters()[:4]
        result = {}
        result['upTotal']   = networkIo[0]
        result['downTotal'] = networkIo[1]
        return result;


sys = System()
result = sys.GetSystem()
print(result)