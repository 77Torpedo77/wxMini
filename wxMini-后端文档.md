#接口文档
## checkElement
检索成分，传入一个有分隔符的字符串，目前支持自动识别中英逗号、顿号三种分隔符。
#### 接口URL
> https://www.example.com/user/api/checkElement

#### 请求方式
> POST

#### Content-Type
> multipart/form-data






#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| language     | CHN |  必填 | language 语言 - CHN：中文；- ENG：英文；- JAP：日语；- KOR：韩语； |
| data     | 乙醇 |  必填 | data 待查询字符串，例：“成分一，成分二” |

#### 成功响应示例
```javascript
[
	{
		"element": "乙醇",
		"alias": "酒精",
		"harm": "常见护肤品主要溶剂之一，肤感好，能造成容易吸收的假象。但去脂力非常强，而且刺激性较强，长期使用会导致角质变薄，皮肤变干失去光泽以及更敏感。因此当乙醇在成分表中排名前5位的时候，干性皮肤，敏感肌或婴幼儿等需要谨慎使用或避免使用。"
	}
]
```


#### 错误响应示例
```javascript
[
	{
		"errcode": -1,
		"errmsg":'错误信息'
	}
]
```


## ocr

#### 接口URL
> https://www.example.com/user/api/ocr

#### 请求方式
> POST

#### Content-Type
> multipart/form-data






#### 请求Body参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| image     | Y/9G/HB7jrUZJFG |  必填 | base64图片编码，注意，无前缀 |
| language     | CHN_ENG |  必填 | language 语言 - CHN_ENG：中英文混合；- ENG：英文；- JAP：日语；- KOR：韩语； |
| openid     | thisisopenid |  必填 | 微信的openid，用于标识用户 |

#### 成功响应示例
```javascript
{
	"log_id": 5465146229346777704,
	"direction": 0,
	"words_result_num": 7,
	"words_result": [
		{
			"words": " openid: cloud. getWxcontext ().OPENID,"
		},
		{
			"words": " name: event. name,"
		},
		{
			"words": " num: event. num,"
		},
		{
			"words": " department: event. department,"
		},
		{
			"words": " degree: event. degree,"
		},
		{
			"words": " school: event. school,"
		},
		{
			"words": " count: db. command.inc (1)"
		}
	]
}
```


#### 错误响应示例
```javascript
错误信息由百度ocr接口返回，具体参考https://cloud.baidu.com/doc/OCR/s/xk3h7ye3f
```
## login
微信登录接口，获取用户openid，请勿直接请求，最好作为wx.login的成功回调
#### 接口URL
> https://www.example.com/user/api/login

#### 请求方式
> GET

#### Content-Type
> multipart/form-data

#### 请求Query参数

| 参数        | 示例值   | 是否必填   |  参数描述  |
| :--------   | :-----  | :-----  | :----  |
| code     | thisiscode | 必填 | - |






#### 成功响应示例
```javascript
o5B384lpOM8FkgYghyPrg0PciSW0//用户的openid
```


#### 错误响应示例
```javascript
错误信息由微信返回
```

#参数设置文档
以下参数均在\application\user\controller\api.php\对应方法
|参数名 |  方法 |说明|
|---|---|---|
|appid |  login  |微信appid|
|secret|login|微信secret|
|APP_ID|ocr|百度|
|API_KEY|ocr|百度|
|SECRET_KEY|ocr|百度|
|admin_name|ocr|数据库中存储的管理员用户名|


#后台管理文档
##后台url：
https://www.example.com/user/admin
##后台登录
默认账号密码为star，如要修改可进入数据库的config表自行修改，**注意：管理员密码以32位md5方式存储，且在修改用户名的同时，请修改参数设置文档中的admin_name参数。**
##后台功能
提供成分查看，成分删除，增加成分，开关每日五次的限制等功能，**当增加成分时，若某一栏为空，请填写null。**

**注意：每日五次限制功能以微信号为标识，且调用ocr接口后不管成功或失败均会计入次数限制。**
