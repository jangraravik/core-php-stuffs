<?php
$token = "YToxNzp7czo2OiJhY3Rpb24iO3M6MTE6ImJvb2tpbmdOZXh0IjtzOjE2OiJ2YWxCb29raW5nRGlzY0lkIjtzOjE6IjciO3M6MTk6InZhbEJvb2tpbmdEaXNjVG90YWwiO3M6NzoiMTUyNS4wNCI7czozMDoidmFsQm9va2luZ0V4dHJhR3Vlc3RBZHVsdEZlZUlkIjtpOjE7czozMzoidmFsQm9va2luZ0V4dHJhR3Vlc3RBZHVsdEZlZVRvdGFsIjtkOjMyMDcuMTk5OTk5OTk5OTk5ODtzOjMwOiJ2YWxCb29raW5nRXh0cmFHdWVzdEFkdWx0VmFsdWUiO2Q6MjtzOjMxOiJ2YWxCb29raW5nRXh0cmFHdWVzdEtpZEZlZVRvdGFsIjtkOjI0MTg7czoyOToidmFsQm9va2luZ0V4dHJhR3Vlc3RLaWRzRmVlSWQiO2k6ODtzOjI5OiJ2YWxCb29raW5nRXh0cmFHdWVzdEtpZHNWYWx1ZSI7ZDoyO3M6MjU6InZhbEJvb2tpbmdFeHRyYUd1ZXN0VG90YWwiO3M6NjoiNTYyNS4yIjtzOjIwOiJ2YWxCb29raW5nR3Vlc3RFbWFpbCI7czoxNDoicmF2aUBlbWFpbC5jb20iO3M6MjA6InZhbEJvb2tpbmdHdWVzdEZOYW1lIjtzOjQ6IlJhdmkiO3M6MjA6InZhbEJvb2tpbmdHdWVzdExOYW1lIjtzOjU6Ikt1bWFyIjtzOjIyOiJ2YWxCb29raW5nR3Vlc3RNZXNzYWdlIjtzOjM2NzoiTG9yZW0gSXBzdW0gaXMgc2ltcGx5IGR1bW15IHRleHQgb2YgdGhlIHByaW50aW5nIGFuZCB0eXBlc2V0dGluZyBpbmR1c3RyeS4gTG9yZW0gSXBzdW0gaGFzIGJlZW4gdGhlIGluZHVzdHJ5J3Mgc3RhbmRhcmQgZHVtbXkgdGV4dCBldmVyIHNpbmNlIHRoZSAxNTAwcywgd2hlbiBhbiB1bmtub3duIHByaW50ZXIgdG9vayBhIGdhbGxleSBvZiB0eXBlIGFuZCBzY3JhbWJsZWQgaXQgdG8gbWFrZSBhIHR5cGUgc3BlY2ltZW4gYm9vay4gSXQgaGFzIHN1cnZpdmVkIG5vdCBvbmx5IGZpdmUgY2VudHVyaWVzLCBidXQgYWxzbyB0aGUgbGVhcCBpbnRvIGVsZWN0cm9uaWMgdHlwZXNldHRpbmcsIHJlbWFpbmluZyBlc3NlbnRpYWxseSB1bmNoYW5nZWQNCiI7czoyMDoidmFsQm9va2luZ0d1ZXN0UGhvbmUiO3M6MTA6Ijk4NzY1NDMyMTAiO3M6MjE6InZhbEJvb2tpbmdPcHRGZWVUb3RhbCI7czoxOiIwIjtzOjE5OiJ2YWxCb29raW5nUmVudFRvdGFsIjtzOjc6IjYxMDAuMTYiO30=";


function isBookingTokenValid($valToken){
	return (base64_encode(base64_decode($valToken, true)) === $valToken) ? true : false;
}

