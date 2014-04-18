<?php
   $V3f0fe = "150000";
$V2435592832 = 7.0;
$Vbf0c8d43a = 30;
$V4852fb2160d2 = 10;
$Va0b78ac85 = TRUE;
  $V10c0d3 = 0;
$Vbc0ce69e = 0;
$V70ecb3 = 0;
$V758799102f7e = 0;
$V1d67f = 0;
$V30ed8d990d2 = 0;
$Vea5b54d = false;
$Vca744e53 = false;
$V76047792b88 = false;
$Vca744e53 = false;
$V9576910 = false;
  if (isset($_REQUEST['form_complete'])) {
 $V10c0d3 = $_REQUEST['sale_price'];
$Vbc0ce69e = $_REQUEST['annual_interest_percent'];
$V70ecb3 = $_REQUEST['year_term'];
$V758799102f7e = $_REQUEST['down_percent'];
$Vca744e53 = (isset($_REQUEST['show_progress'])) ? $_REQUEST['show_progress'] : false;
$Vea5b54d = $_REQUEST['form_complete'];
}
  
 if (!headers_sent()) {
 print("<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'><HTML>");
print("<head><title>Mortgage Calculator</title></HEAD><BODY>");
print("<body bgcolor=\'#33ccff\'>");
print("<H1 style=\'margin-bottom: 35px;\'>PHP Mortgage Calculator</h1>");
print("<hr>\n\n");
$Vf0c27 = TRUE;
} else {
 $Vf0c27 = FALSE;
} 
 ?>
 <style type="text/css">
 <!--
 td {
 font-size : 11px; 
 font-family : tahoma, helvetica, arial, lucidia, sans-serif; 
 color : 
 }
-->
 </style> 
 <?php 
     
 function F6f543af4($V70ecb3, $Vac5e9) {
 global $Ve3fbaf;

 $Vd3bfece9b4d = 0;
$Ve3fbaf = 1 + $Vac5e9;
$V919b188f43 = $Ve3fbaf;
for ($i=0; $i < ($V70ecb3 * 12); $i++) {
 $Vd3bfece9b4d += (1 / $V919b188f43);
$V919b188f43 *= $Ve3fbaf;
}
return $Vd3bfece9b4d;
} 
   
 if ($Vea5b54d) {    
 $V10c0d3 = ereg_replace( "[^0-9.]", "", $V10c0d3);
$Vbc0ce69e = eregi_replace("[^0-9.]", "", $Vbc0ce69e);
$V70ecb3 = eregi_replace("[^0-9.]", "", $V70ecb3);
$V758799102f7e = eregi_replace("[^0-9.]", "", $V758799102f7e);

 if (((float) $V70ecb3 <= 0) || ((float) $V10c0d3 <= 0) || ((float) $Vbc0ce69e <= 0)) {
 $V9576910 = "You must enter a <b>Sale Price of Home</b>, <b>Length of Motgage</b> <i>and</i> <b>Annual Interest Rate</b>";
}

 if (!$V9576910) {
 $V985f32a4 = $V70ecb3 * 12;
$V66ed9d44 = $V10c0d3 * ($V758799102f7e / 100);
$V00e04 = $Vbc0ce69e / 100;
$Vac5e9 = $V00e04 / 12;
$V38435e1130 = $V10c0d3 - $V66ed9d44;
$V68b8b = F6f543af4($V70ecb3, $Vac5e9);
$V76047792b88 = $V38435e1130 / $V68b8b;
}
} else {
 if (!$V10c0d3) { $V10c0d3 = $V3f0fe; }
if (!$Vbc0ce69e) { $Vbc0ce69e = $V2435592832; }
if (!$V70ecb3) { $V70ecb3 = $Vbf0c8d43a; }
if (!$V758799102f7e) { $V758799102f7e = $V4852fb2160d2; }
if (!$Vca744e53) { $Vca744e53 = $Va0b78ac85; }
}

 if ($V9576910) {
 print("<font color=\"red\">" . $V9576910 . "</font><br><br>\n");
$Vea5b54d = false;
}
?>
<font size="-1" color="#000000">This <b>mortgage calculator</b> can be used to figure out monthly payments of a home mortgage loan, based on the home's sale price, the term of the loan desired, buyer's down payment percentage, and the loan's interest rate. This calculator factors in PMI (Private Mortgage Insurance) for loans where less than 20% is put as a down payment. Also taken into consideration are the town property taxes, and their effect on the total monthly mortgage payment.<br></font>
<form method="GET" name="information" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="form_complete" value="1">
<table cellpadding="2" cellspacing="0" border="0" width="100%">
 <tr valign="top">
 <td align="right"><img src="/images/clear.gif" width="225" height="1" border="0" alt=""></td>
 <td align="smalltext" width="100%"><img src="/images/clear.gif" width="250" height="1" border="0" alt=""></td>
 </tr>
 <tr valign="top" bgcolor="#cccccc">
 <td align="center" colspan="2"><b>Purchase &amp; Financing Information</b></td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Sale Price of Home:</td>
 <td width="100%"><input type="text" size="10" name="sale_price" value="<?php echo $V10c0d3; ?>">(In Dollars)</td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Percentage Down:</td>
 <td><input type="text" size="5" name="down_percent" value="<?php echo $V758799102f7e; ?>">%</td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Length of Mortgage:</td>
 <td><input type="text" size="3" name="year_term" value="<?php echo $V70ecb3; ?>">years</td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Annual Interest Rate:</td>
 <td><input type="text" size="5" name="annual_interest_percent" value="<?php echo $Vbc0ce69e; ?>">%</td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Explain Calculations:</td>
 <td><input type="checkbox" name="show_progress" value="1" <?php if ($Vca744e53) { print("checked"); } ?>> Show me the calculations and amortization</td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td>&nbsp;</td>
 <td><input type="submit" value="Calculate"><br><?php if ($Vea5b54d) { print("<a href=\"" . $_SERVER['PHP_SELF'] . "\">Start Over</a><br>"); } ?><br></td>
 </tr>
<?php   
 if ($Vea5b54d && $V76047792b88) {
?>
 <tr valign="top">
 <td align="center" colspan="2" bgcolor="#000000"><font color="#ffffff"><b>Mortgage Payment Information</b></font></td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Down Payment:</td>
 <td><b><?php echo "\$" . number_format($V66ed9d44, "2", ".", "thousands_sep"); ?></b></td>
 </tr>
 <tr valign="top" bgcolor="#eeeeee">
 <td align="right">Amount Financed:</td>
 <td><b><?php echo "\$" . number_format($V38435e1130, "2", ".", "thousands_sep"); ?></b></td>
 </tr>
 <tr valign="top" bgcolor="#cccccc">
 <td align="right">Monthly Payment:</td>
 <td><b><?php echo "\$" . number_format($V76047792b88, "2", ".", "thousands_sep"); ?></b><br><font>(Principal &amp; Interest ONLY)</font></td>
 </tr>
 <?php
 if ($V758799102f7e >= 20)
 $V9045a51b4b0=0; 
 else {
 $V9045a51b4b0 = 55 * ($V38435e1130 / 100000);
?>
 <tr valign="top" bgcolor="#FFFFCC">
 <td align="right">&nbsp;</td>
 <td>
 <br>
 Since you are putting LESS than 20% down, you will need to pay PMI (<a href="http://www.google.com/search?hl=en&q=private+mortgage+insurance">Private Mortgage Insurance</a>), which tends to be about $55 per month for every $100,000 financed (until you have paid off 20% of your loan). This could add <?php echo "\$" . number_format($V9045a51b4b0, "2", ".", "thousands_sep"); ?> to your monthly payment.
 </td>
 </tr>
 <tr valign="top" bgcolor="#FFFF99">
 <td align="right">Monthly Payment:</td>
 <td><b><?php echo "\$" . number_format(($V76047792b88 + $V9045a51b4b0), "2", ".", "thousands_sep"); ?></b><br><font>(Principal &amp; Interest, and PMI)</td>
 </tr>
 <?php
 }
?>
 <tr valign="top" bgcolor="#CCCCFF">
 <td align="right">&nbsp;</td>
 <td>
 <br>
 <?php
 $V820767798b4d = ($V10c0d3 * .85);
$Va9e5a = ($V820767798b4d / 1000) * 14;
$Vf47b810b = $Va9e5a / 12;

 if ($V9045a51b4b0 == 0)
 $V8aeb2c4 = "";
else {
 $V8aeb2c4 = "PMI and ";
}
?>
 Residential (or Property) Taxes are a little harder to figure out... In Massachusetts, the average resedential tax rate seems to be around $14 per year for every $1,000 of your property's assessed value.
 <br><br>
 Let's say that your property's <i>assessed value</i> is 85% of what you actually paid for it - <?php echo "\$" . number_format($V820767798b4d, "2", ".", "thousands_sep"); ?>. This would mean that your yearly residential taxes will be around <?php echo "\$" . number_format($Va9e5a, "2", ".", "thousands_sep"); ?>
 This could add <?php echo "\$" . number_format($Vf47b810b, "2", ".", "thousands_sep"); ?> to your monthly payment.
 </td>
 </tr>
 <tr valign="top" bgcolor="#9999FF">
 <td align="right">TOTAL Monthly Payment:</td>
 <td><b><?php echo "\$" . number_format(($V76047792b88 + $V9045a51b4b0 + $Vf47b810b), "2", ".", "thousands_sep"); ?></b><br><font>(including <?php echo $V8aeb2c4; ?> residential tax)</font></td>
 </tr>
<?php 
 }
?>
</table>
</form>
<?php   
 if ($Vea5b54d && $Vca744e53) {
 $V352ea1e = 1;
?>
 <br><br>
 <table cellpadding="5" cellspacing="0" border="1" width="100%">
 <tr valign="top">
 <td><b><?php echo $V352ea1e++; ?></b></td>
 <td>
 The <b>down payment</b> = The price of the home multiplied by the percentage down divided by 100 (for 5% down becomes 5/100 or 0.05)<br><br>
 $<?php echo number_format($V66ed9d44,"2",".","thousands_sep"); ?> = $<?php echo number_format($V10c0d3,"2",".","thousands_sep"); ?> X (<?php echo $V758799102f7e; ?> / 100)
 </td>
 </tr>
 <tr valign="top">
 <td><b><?php echo $V352ea1e++; ?></b></td>
 <td>
 The <b>interest rate</b> = The annual interest percentage divided by 100<br><br>
 <?php echo $V00e04; ?> = <?php echo $Vbc0ce69e; ?>% / 100
 </td>
 </tr>
 <tr valign="top" bgcolor="#cccccc">
 <td colspan="2">
 The <b>monthly factor</b> = The result of the following formula:
 </td>
 </tr>
 <tr valign="top">
 <td><b><?php echo $V352ea1e++; ?></b></td>
 <td>
 The <b>monthly interest rate</b> = The annual interest rate divided by 12 (for the 12 months in a year)<br><br>
 <?php echo $Vac5e9; ?> = <?php echo $V00e04; ?> / 12
 </td>
 </tr>
 <tr valign="top">
 <td><b><?php echo $V352ea1e++; ?></b></td>
 <td>
 The <b>month term</b> of the loan in months = The number of years you've taken the loan out for times 12<br><br>
 <?php echo $V985f32a4; ?> Months = <?php echo $V70ecb3; ?> Years X 12
 </td>
 </tr>
 <tr valign="top">
 <td><b><?php echo $V352ea1e++; ?></b></td>
 <td>
 The montly payment is figured out using the following formula:<br>
 Monthly Payment = <?php echo number_format($V38435e1130, "2", "", ""); ?> * (<?php echo number_format($Vac5e9, "4", "", ""); ?> / (1 - ((1 + <?php echo number_format($Vac5e9, "4", "", ""); ?>)<sup>-(<?php echo $V985f32a4; ?>)</sup>)))
 <br><br>
 The <a href="#amortization">amortization</a> breaks down how much of your monthly payment goes towards the bank's interest, and how much goes into paying off the principal of your loan.
 </td>
 </tr>
 </table>
 <br>
<?php 
 $V037c3ca06f = $V38435e1130;
$V64f35e2b51 = 1;
$Vc93a9bf6a0 = 1; 
 $V966a6 = -($V985f32a4);
$V168476af = pow((1 + $Vac5e9), $V966a6);
$V76047792b88 = $V037c3ca06f * ($Vac5e9 / (1 - $V168476af));

 print("<br><br><a name=\"amortization\"></a>Amortization For Monthly Payment: <b>\$" . number_format($V76047792b88, "2", ".", "thousands_sep") . "</b> over " . $V70ecb3 . " years<br>\n");
print("<table cellpadding=\"5\" cellspacing=\"0\" bgcolor=\"#eeeeee\" border=\"1\" width=\"100%\">\n"); 
 $V4c0d3bf = "\t<tr valign=\"top\" bgcolor=\"#cccccc\">\n";
$V4c0d3bf .= "\t\t<td align=\"right\"><b>Month</b></td>\n";
$V4c0d3bf .= "\t\t<td align=\"right\"><b>Interest Paid</b></td>\n";
$V4c0d3bf .= "\t\t<td align=\"right\"><b>Principal Paid</b></td>\n";
$V4c0d3bf .= "\t\t<td align=\"right\"><b>Remaing Balance</b></td>\n";
$V4c0d3bf .= "\t</tr>\n";

 echo $V4c0d3bf;  
 while ($V64f35e2b51 <= $V985f32a4) { 
 $Vfd77cde9a0bf = $V037c3ca06f * $Vac5e9;
$V8a2f6ec01 = $V76047792b88 - $Vfd77cde9a0bf;
$V0b78f33 = $V037c3ca06f - $V8a2f6ec01;

 $V1d67f = $V1d67f + $Vfd77cde9a0bf;
$V30ed8d990d2 = $V30ed8d990d2 + $V8a2f6ec01;

 print("\t<tr valign=\"top\" bgcolor=\"#eeeeee\">\n");
print("\t\t<td align=\"right\">" . $V64f35e2b51 . "</td>\n");
print("\t\t<td align=\"right\">\$" . number_format($Vfd77cde9a0bf, "2", ".", "thousands_sep") . "</td>\n");
print("\t\t<td align=\"right\">\$" . number_format($V8a2f6ec01, "2", ".", "thousands_sep") . "</td>\n");
print("\t\t<td align=\"right\">\$" . number_format($V0b78f33, "2", ".", "thousands_sep") . "</td>\n");
print("\t</tr>\n");

 ($V64f35e2b51 % 12) ? $Vdee486cd3 = FALSE : $Vdee486cd3 = TRUE;

 if ($Vdee486cd3) {
 print("\t<tr valign=\"top\" bgcolor=\"#ffffcc\">\n");
print("\t\t<td colspan=\"4\"><b>Totals for year " . $Vc93a9bf6a0 . "</td>\n");
print("\t</tr>\n");

 $V33526c9127e = $V1d67f + $V30ed8d990d2;
print("\t<tr valign=\"top\" bgcolor=\"#ffffcc\">\n");
print("\t\t<td>&nbsp;</td>\n");
print("\t\t<td colspan=\"3\">\n");
print("\t\t\tYou will spend \$" . number_format($V33526c9127e, "2", ".", "thousands_sep") . " on your house in year " . $Vc93a9bf6a0 . "<br>\n");
print("\t\t\t\$" . number_format($V1d67f, "2", ".", "thousands_sep") . " will go towards INTEREST<br>\n");
print("\t\t\t\$" . number_format($V30ed8d990d2, "2", ".", "thousands_sep") . " will go towards PRINCIPAL<br>\n");
print("\t\t</td>\n");
print("\t</tr>\n");

 print("\t<tr valign=\"top\" bgcolor=\"#ffffff\">\n");
print("\t\t<td colspan=\"4\">&nbsp;<br><br></td>\n");
print("\t</tr>\n");

 $Vc93a9bf6a0++;
$V1d67f = 0;
$V30ed8d990d2 = 0;

 if (($V64f35e2b51 + 6) < $V985f32a4) {
 echo $V4c0d3bf;
}
}

 $V037c3ca06f = $V0b78f33;
$V64f35e2b51++;
}
print("</table>\n");
}
?>
<br>
<!-- END BODY -->
<?php
 if ($Vf0c27) {
 print("</body>\n");
print("</BODY>
</HTML>\n");
}
?>
