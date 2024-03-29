import json
import hashlib as hb
from pyDes import des, CBC, PAD_PKCS5 # des
import base64

path = 'D:\Gitinit\py-MD5\MD5test.txt'#文檔路徑
with open(path,'r') as f:
        data = json.load(f) #讀取資料 為dict方式
#print(data) #全部資料
str2 = data['str']
DES = data['DES']
KEY = data['KEY']
iv = data['iv']
print("原來的str",str2 , "\n")

#改變字串 AD
AD=str2.replace('g','j',1) 
print("更改一個字",AD)



# MDvsMD'比對
AD = (hb.md5(AD.encode('utf-8'))).hexdigest()
#print(AD)

#DES 解密
k = des(KEY , CBC , iv , pad=None , padmode=PAD_PKCS5)
#為了輸出時比較好看 有先特別去改變樣子
DES = DES.encode('utf-8')
DES = base64.b64decode(DES)
#解密
de = k.decrypt(DES)
de = de.decode('utf-8')

print("\nMD ",de,"\nMD'",AD)
if str(de) != str(AD):
     print("有被竄改過\n")


#原本的MD
MD = (hb.md5(str2.encode('utf-8'))).hexdigest() 
#print(MD)

print("原來的str",str2)
print("\nMD ",de,"\nMD'",MD)
if str(de) == str(MD):
     print("金鑰正確\n")