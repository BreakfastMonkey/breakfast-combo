<?php
    $fontFamily = "font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;";
    $defaultFont = $fontFamily . " font-size: 14px; line-height: 20px;";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
	</head>
	<body style="background: #EDF0F1;">
		
		<table width="100%" cellpadding="0" cellspacing="0" style="background: #EDF0F1;">
			<tr>
				<td>
					
					<table width="600" cellpadding="0" cellspacing="0" style="margin:0 auto;">
						<tr>
							<td style="padding: 20px;">
								
								<table width="100%" cellpadding="0" cellspacing="0" style="background: #FFFFFF;">
								<?php /*
                  <tr>
                    <td style="padding: 40px 40px 20px; font-family: Arial, sans-serif; font-size: 36px; line-height: 40px;  color: #000; margin: 0;">
                      <?= $this->Html->image('logo.png', ['alt' => "", 'fullBase' => true, 'width' => '230px']); ?>
                    </td>
                  </tr>
                */ ?>
									<tr>
										<td style="padding: 20px 40px 40px; <?= $defaultFont ?>">
                      <?php echo $this->fetch('content'); ?>
										</td>
									</tr>
								</table>
								
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</table>
		
	</body>
</html>