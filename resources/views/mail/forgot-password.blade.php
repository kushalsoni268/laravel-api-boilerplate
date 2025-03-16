@extends('mail.layout.app')
@section('content')
<div class="u-row-container" style="padding: 0px;background-color: transparent">
	<div class="u-row"
	style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #161a39;">
	<div
	style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">	
	<div class="u-col u-col-100"
		style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
		<div style="height: 100%;width: 100% !important;">		
		<div
			style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
			<!-- <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
				width="100%" border="0">
				<tbody>
					<tr>
					<td
						style="overflow-wrap:break-word;word-break:break-word;padding:35px 10px 10px;font-family:'Lato',sans-serif;"
						align="left">

						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td style="padding-right: 0px;padding-left: 0px;" align="center">

							<img align="center" border="0" src="{{ asset('assets/admin/email-template/image-1.png') }}" alt="Image" title="Image"
								style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 10%;max-width: 58px;"
								width="58" />

							</td>
						</tr>
						</table>
					</td>
					</tr>
				</tbody>
			</table> -->

			<table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
			width="100%" border="0">
			<tbody>
				<tr>
				<td
					style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 30px;font-family:'Lato',sans-serif;"
					align="left">

					<div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
					<p style="font-size: 14px; line-height: 140%; text-align: center;"><span
						style="font-size: 28px; line-height: 39.2px; color: #ffffff; font-family: Lato, sans-serif;">Reset Password</span></p>
					</div>

				</td>
				</tr>
			</tbody>
			</table>
		</div>
		</div>
	</div>	
	</div>
	</div>
</div>

<div class="u-row-container" style="padding: 0px;background-color: transparent">
	<div class="u-row"
		style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
		<div
			style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">		
		<div class="u-col u-col-100"
			style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
			<div style="height: 100%;width: 100% !important;">
			<div
				style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
				<table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
				width="100%" border="0">
				<tbody>
					<tr>
					<td
						style="overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;font-family:'Lato',sans-serif;"
						align="left">
						
						<div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
						<p style="font-size: 14px; line-height: 140%;"><span
							style="font-size: 18px; line-height: 25.2px; color: #666666;">Hello {{$name}},</span></p>
						<p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
						<p style="font-size: 14px; line-height: 140%;"><span
							style="font-size: 18px; line-height: 25.2px; color: #666666;">We have received a request of forgot password, Please click on the below link to reset your password.</span></p>						
					</td>
					</tr>
				</tbody>
				</table>

				<table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
				width="100%" border="0">
				<tbody>
					<tr>
					<td
						style="overflow-wrap:break-word;word-break:break-word;padding:0px 40px;font-family:'Lato',sans-serif;"
						align="left">						
						<div align="left">						
						<a href="{{$url}}" target="_blank" class="v-button"
							style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #18163a; border-radius: 1px;-webkit-border-radius: 1px; -moz-border-radius: 1px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;font-size: 14px;">
							<span style="display:block;padding:15px 40px;line-height:120%;"><span
								style="font-size: 18px; line-height: 21.6px;">Reset Password</span></span>
						</a>
						</div>
					</td>
					</tr>
				</tbody>
				</table>

				<table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0"
				width="100%" border="0">
				<tbody>
					<tr>
					<td
						style="overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;font-family:'Lato',sans-serif;"
						align="left">

						<div style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
						<p style="font-size: 14px; line-height: 140%;"><span
							style="color: #888888; font-size: 14px; line-height: 19.6px;"><em><span
								style="font-size: 16px; line-height: 22.4px;">Please ignore this email if you
								did not request a password change.</span></em></span><br /><span
							style="color: #888888; font-size: 14px; line-height: 19.6px;"><em><span
								style="font-size: 16px; line-height: 22.4px;">&nbsp;</span></em></span></p>
						</div>

					</td>
					</tr>
				</tbody>
				</table>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
@stop