<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<div>
			<h1>تم استلام طلب جديد</h1>
			<p>تم استلام طلب جديد وحالته الان قيد التدقيق وسيتم التواصل معكم من قبل ادارة التطبيق لاحقا</p>
			<br/>
			<br/>
			<table border="1" width="100%;">
				<tr>
					<td>الاسم</td>
					<td>{{ $name }}</td>
				</tr>
				<tr>
					<td>البريد الالكتروني</td>
					<td>{{ $email }}</td>
				</tr>
				<tr>
					<td>العنوان </td>
					<td>{{ $address }}</td>
				</tr>
				<tr>
					<td>رقم الطلب </td>
					<td>{{ $order_id }}</td>
				</tr>
			</table>
			<br/>
			<p>رقم التتبع</p>
			<p>{{ $tracking_number }}</p>
		</div>
	</center>
</body>
</html>