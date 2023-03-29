<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>الدفع للطلب</title>
	</head>
	<body>
		<style>
			.PT_express_checkout {
				height: 550px;
			}

			.result {
				display: none;
			}

			.result.success {
				background-color: green;
			}

			.result.failed {
				background-color: red;
			}
			
			.btn-primary {
				background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
				background-color:#3d94f6;
				border-radius:6px;
				border:1px solid #337fed;
				display:inline-block;
				cursor:pointer;
				color:#ffffff;
				font-family:Arial;
				font-size:18px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:0px 1px 0px #1570cd;
			}
			.btn-primary:hover {
				background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
				background-color:#1e62d0;
			}
			.btn-primary:active {
				position:relative;
				top:1px;
			}
		</style>
		<script>
			const credintials = {
				merchant_id: "10065534",
				secret_key: "r8qiwrPtTBKhBH5tJiVzednSYuzuNfqfoRxUjnncY8uzPz3zSY87cwZa0zEOO53dXB7gZvtXDYxtyA2qzaxLHxWI7BwVGA9EcgUb",
			};
		</script>
		<div class="result success">Payment successed</div>
		<div class="result failed">Payment failed</div>

		<div>
    		<div style="text-align: center; direction: rtl; padding-bottom: 20px;" id="note_before">
    			<h4>
    				الغاء عملية الدفع؟
    			</h4>
    			<p>
    				سيترتب عليها الغاء الطلب, بالتالي لن تتمكن من متابعة الطلب فيما بعد!
    			</p>
    			<p>
    				ملاحظة: في حال فشلت العملية او تم ظهور رسالة خطأ .. الرجاء إلغاء الطلب من هنا
    			</p>
    			<a href="https://almaridcars.com/almarid/public/api/orders/pay_result?result=reject&order_id={{ $order['id'] }}" class="btn-primary" onclick="return confirm('تأكيد العملية؟')">
    				الغاء الطلب
    			</a>
    		</div>
			<link rel="stylesheet" href="https://www.paytabs.com/theme/express_checkout/css/express.css">
			<script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
			<script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<!-- Button Code for PayTabs Express Checkout -->
			<div class="PT_express_checkout"></div>
			<script type="text/javascript">
				Paytabs("#express_checkout").expresscheckout({
						settings: {
							...credintials,
							amount: "{{ $order['deposit'] }}",
							currency: "AED",
							title: "AlMarid",
							product_names: "{{ $order->product['name_en']? $order->product['name_en'] : $order->product['name_ar'] }}",
							order_id: {{ $order['id'] }},
							url_redirect: "https://almaridcars.com/almarid/public/api/orders/pay_result?result=success&order_id={{ $order['id'] }}",
							display_customer_info: 0,
							display_billing_fields: 0,
							display_shipping_fields: 0,
							language: "en",
							redirect_on_reject: 0,
							is_iframe: {
								load: "onbodyload",
								show: 1
							},
							is_self: 1,
							url_cancel: "https://almaridcars.com/almarid/public/api/orders/pay_result?result=cancel&order_id={{ $order['id'] }}"
						},
						customer_info: {
							first_name: "{{ $order['name']? $order['name'] : 'AlMarid'}}",
							last_name: "{{ $order['last_name']? $order['last_name'] : 'Cars'}}",
							phone_number: "{{ $order['mobile']? $order['mobile'] : '1234567'}}",
							email_address: "{{ $order['email']? $order['email'] : 'orderer@almarid.com'}}",
							country_code: "973"
						},
						billing_address: {
							full_address: "Dubai, UAE",
							city: "Dubai",
							state: "Dubai",
							country: "ARE",
							postal_code: "00973"
						}
				});
            	$(document).on('click', '#PT_checkout_submit', function() {
            	    alert('test');
            	});
			</script>
		</div>
	</body>
</html>
