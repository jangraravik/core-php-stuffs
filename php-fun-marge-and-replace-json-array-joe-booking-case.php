<?php

$jsonArray = '{
	"2015-12-01":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-02":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-03":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-04":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-05":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-06":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-07":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-08":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-09":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"},
	"2015-12-10":{"available":0,"bind":0,"info":"","notes":"","price":100,"promo":0,"status":"available"}
	}';
$dataRateArray = json_decode($jsonArray, true);
//print_r($dataRateArray);exit;

$jsonArray = '{
	"2015-12-07":{"available":0,"bind":0,"info":"","notes":"","price":0,"promo":0,"status":"booked"},
	"2015-12-08":{"available":0,"bind":0,"info":"","notes":"","price":0,"promo":0,"status":"booked"},
	"2015-12-09":{"available":0,"bind":0,"info":"","notes":"","price":0,"promo":0,"status":"booked"}
	}';
$dataBookingArray = json_decode($jsonArray, true);
//print_r($dataBookingArray);exit;


print_r(array_replace_recursive($dataRateArray,$dataBookingArray));