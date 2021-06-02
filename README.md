#### random 用法
```py
chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789' #random範圍
length = len(chars)-1
for i in range(1000):
    #randint 包含 兩個數字 randrange包含起點沒有包含終點
    str+=chars[random.randint(0,length)]
```
#### md5
```py
# 訊息摘要 md5 產生 128bits 0/1 會再以32bits個hex顯示
MD=(hb.md5(str.encode("utf-8"))).hexdigest()# 訊息摘要
print ("訊息摘要 (md5)",MD)
'''
binary 的方式 =>先從 16轉成 integer 再轉bin
ad = int(MD,16)
print (bin(ad))
'''
```
### CBC = 像是chain 要加密當前明文區塊需要前一個密文區塊
### EBC = 直接切割明文block 切完以後 明文跟密文是1v1的關係
### mode 為 CBC時候 需要有個IV向量

#### #(key,mode,initial value, pad , padmode)
```py
iv = "".join(random.sample('0123456789',8))#list >> str 用join
k = des(KEY , CBC , iv , pad=None , padmode=PAD_PKCS5)
#加密 出來是 object的樣式
# 類似這樣 /x64/x12/x...
en = k.encrypt(MD)
ba = (base64.b64encode(en).decode("utf-8"))
'''
#要消除b '' 只需要decode
de= k.decrypt(en)
de =de.decode("utf-8")
print(de)
'''
```
#### 寫json
```py
lines = {"str":str,'MD5':MD,'DES':ba,'KEY':KEY,'iv':iv}
#如果會忘記 close 可以改用 with as
with open(path,'w') as f:
    json.dump(lines,f)
```
##### 參考資料
##### github
##### https://github.com/twhiteman/pyDes
##### pydes教學
##### https://malagege.github.io/blog/2015/04/26/logdown/2015-04-26-python-use-pydespy-encryption-and-decryption/
##### CBC EBC
##### https://notes.andywu.tw/2019/%E5%AF%86%E7%A2%BC%E7%9A%84%E5%8A%A0%E5%AF%86%E6%A8%A1%E5%BC%8Fecb-cbc-cfb-ofb-ctr/
##### json寫法
##### https://jenifers001d.github.io/2019/12/11/Python/learning-Python-day9/