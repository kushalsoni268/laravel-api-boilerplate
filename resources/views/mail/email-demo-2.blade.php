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
						style="font-size: 28px; line-height: 39.2px; color: #ffffff; font-family: Lato, sans-serif;">Demo Email</span></p>
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
							style="font-size: 18px; line-height: 25.2px; color: #666666;">Hello {{$data['name']}},</span></p>
						<p style="font-size: 14px; line-height: 140%;">&nbsp;</p>
						<p style="font-size: 14px; line-height: 140%;"><span
							style="font-size: 18px; line-height: 25.2px; color: #666666;">This is a demo email.</span></p>						
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