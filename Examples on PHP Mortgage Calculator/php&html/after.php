<?php
    /*
        PHP Mortgage Calculator
        version: 1.1
        last update: Jan 1, 2003
        ----------------------------------------------------
        The PHP Mortgage Calculator tries to figure out a home 
        owners mortgage payments, and the breakdown of each monthly
        payment.
        
        The calculator accepts:
            Price (cost of home in US Dollars)
            Percentage of Down Payment
            Length of Mortgage
            Annual Interest Rate
        
        Based on the four items that the user enters, we can figure
        out the down payment (in US Dollars), the ammount that the 
        buyer needs to finance, and the monthly finance payment. 
        The calculator can also break down the monthly payments 
        so we know how much goes towards the mortgage's interest, 
        the mortgage's principal, the loan's Private Mortgage Insurance 
        (if less that 20% was used as a down payment), and an rough 
        estimate of the property's residential tax
        
        [ See below for LICENSE ]
    */
    
    /* --------------------------------------------------- *
     * Set Form DEFAULT values
     * --------------------------------------------------- */
    $default_sale_price              = "150000";
    $default_annual_interest_percent = 7.0;
    $default_year_term               = 30;
    $default_down_percent            = 10;
    $default_show_progress           = TRUE;
    /* --------------------------------------------------- */
    


    /* --------------------------------------------------- *
     * Initialize Variables
     * --------------------------------------------------- */
    $sale_price                      = 0;
    $annual_interest_percent         = 0;
    $year_term                       = 0;
    $down_percent                    = 0;
    $this_year_interest_paid         = 0;
    $this_year_principal_paid        = 0;
    $form_complete                   = false;
    $show_progress                   = false;
    $monthly_payment                 = false;
    $show_progress                   = false;
    $error                           = false;
    /* --------------------------------------------------- */


    /* --------------------------------------------------- *
     * Set the USER INPUT values
     * --------------------------------------------------- */
    if (isset($_REQUEST['form_complete'])) {
        $sale_price                      = $_REQUEST['sale_price'];
        $annual_interest_percent         = $_REQUEST['annual_interest_percent'];
        $year_term                       = $_REQUEST['year_term'];
        $down_percent                    = $_REQUEST['down_percent'];
        $show_progress                   = (isset($_REQUEST['show_progress'])) ? $_REQUEST['show_progress'] : false;
        $form_complete                   = $_REQUEST['form_complete'];
    }
    /* --------------------------------------------------- */
    
    
    // If HTML headers have not already been sent, we'll print some here    
    if (!headers_sent()) {
        print("<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'><HTML>");
        print("<head><title>Mortgage Calculator</title></HEAD><BODY>");
        print("<body bgcolor=\'#33ccff\'>");
        print("<H1 style=\'margin-bottom: 35px;\'>PHP Mortgage Calculator</h1>");
        print("<hr>\n\n");
        $print_footer = TRUE;
    } else {
       $print_footer = FALSE;
    }
    
    // Style Sheet
    ?>
    <style type="text/css">
        <!--
            td {
                font-size : 11px; 
                font-family : tahoma, helvetica, arial, lucidia, sans-serif; 
                color : #000000; 
            }
        -->
    </style> 


    <?php    
    /* --------------------------------------------------- */
    // This function does the actual mortgage calculations
    // by plotting a PVIFA (Present Value Interest Factor of Annuity)
    // table...
    function get_interest_factor($year_term, $monthly_interest_rate) {
        global $base_rate;
        
        $factor      = 0;
        $base_rate   = 1 + $monthly_interest_rate;
        $denominator = $base_rate;
        for ($i=0; $i < ($year_term * 12); $i++) {
            $factor += (1 / $denominator);
            $denominator *= $base_rate;
        }
        return $factor;
    }        
    /* --------------------------------------------------- */

    // If the form is complete, we'll start the math
    if ($form_complete) {
        // We'll set all the numeric values to JUST
        // numbers - this will delete any dollars signs,
        // commas, spaces, and letters, without invalidating
        // the value of the number
        $sale_price              = ereg_replace( "[^0-9.]", "", $sale_price);
        $annual_interest_percent = eregi_replace("[^0-9.]", "", $annual_interest_percent);
        $year_term               = eregi_replace("[^0-9.]", "", $year_term);
        $down_percent            = eregi_replace("[^0-9.]", "", $down_percent);
        
        if (((float) $year_term <= 0) || ((float) $sale_price <= 0) || ((float) $annual_interest_percent <= 0)) {
            $error = "You must enter a <b>Sale Price of Home</b>, <b>Length of Motgage</b> <i>and</i> <b>Annual Interest Rate</b>";
        }
        
        if (!$error) {
            $month_term              = $year_term * 12;
            $down_payment            = $sale_price * ($down_percent / 100);
            $annual_interest_rate    = $annual_interest_percent / 100;
            $monthly_interest_rate   = $annual_interest_rate / 12;
            $financing_price         = $sale_price - $down_payment;
            $monthly_factor          = get_interest_factor($year_term, $monthly_interest_rate);
            $monthly_payment         = $financing_price / $monthly_factor;
        }
    } else {
        if (!$sale_price)              { $sale_price              = $default_sale_price;              }
        if (!$annual_interest_percent) { $annual_interest_percent = $default_annual_interest_percent; }
        if (!$year_term)               { $year_term               = $default_year_term;               }
        if (!$down_percent)            { $down_percent            = $default_down_percent;            }
        if (!$show_progress)           { $show_progress           = $default_show_progress;           }
    }
    
    if ($error) {
        print("<font color=\"red\">" . $error . "</font><br><br>\n");
        $form_complete   = false;
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
        <td width="100%"><input type="text" size="10" name="sale_price" value="<?php echo $sale_price; ?>">(In Dollars)</td>
    </tr>
    <tr valign="top" bgcolor="#eeeeee">
        <td align="right">Percentage Down:</td>
        <td><input type="text" size="5" name="down_percent" value="<?php echo $down_percent; ?>">%</td>
    </tr>
    <tr valign="top" bgcolor="#eeeeee">
        <td align="right">Length of Mortgage:</td>
        <td><input type="text" size="3" name="year_term" value="<?php echo $year_term; ?>">years</td>
    </tr>
    <tr valign="top" bgcolor="#eeeeee">
        <td align="right">Annual Interest Rate:</td>
        <td><input type="text" size="5" name="annual_interest_percent" value="<?php echo $annual_interest_percent; ?>">%</td>
    </tr>
    <tr valign="top" bgcolor="#eeeeee">
        <td align="right">Explain Calculations:</td>
        <td><input type="checkbox" name="show_progress" value="1" <?php if ($show_progress) { print("checked"); } ?>> Show me the calculations and amortization</td>
    </tr>
    <tr valign="top" bgcolor="#eeeeee">
        <td>&nbsp;</td>
        <td><input type="submit" value="Calculate"><br><?php if ($form_complete) { print("<a href=\"" . $_SERVER['PHP_SELF'] . "\">Start Over</a><br>"); } ?><br></td>
    </tr>
<?php
    // If the form has already been calculated, the $down_payment
    // and $monthly_payment variables will be figured out, so we
    // can show them in this table
    if ($form_complete && $monthly_payment) {
?>
        <tr valign="top">
            <td align="center" colspan="2" bgcolor="#000000"><font color="#ffffff"><b>Mortgage Payment Information</b></font></td>
        </tr>
        <tr valign="top" bgcolor="#eeeeee">
            <td align="right">Down Payment:</td>
            <td><b><?php echo "\$" . number_format($down_payment, "2", ".", "thousands_sep"); ?></b></td>
        </tr>
        <tr valign="top" bgcolor="#eeeeee">
            <td align="right">Amount Financed:</td>
            <td><b><?php echo "\$" . number_format($financing_price, "2", ".", "thousands_sep"); ?></b></td>
        </tr>
        <tr valign="top" bgcolor="#cccccc">
            <td align="right">Monthly Payment:</td>
            <td><b><?php echo "\$" . number_format($monthly_payment, "2", ".", "thousands_sep"); ?></b><br><font>(Principal &amp; Interest ONLY)</font></td>
        </tr>
        <?php
            if ($down_percent >= 20)
               $pmi_per_month=0; // no PMI
            else {
                $pmi_per_month = 55 * ($financing_price / 100000);
        ?>
                <tr valign="top" bgcolor="#FFFFCC">
                    <td align="right">&nbsp;</td>
                    <td>
                        <br>
                        Since you are putting LESS than 20% down, you will need to pay PMI (<a href="http://www.google.com/search?hl=en&q=private+mortgage+insurance">Private Mortgage Insurance</a>), which tends to be about $55 per month for every $100,000 financed (until you have paid off 20% of your loan). This could add <?php echo "\$" . number_format($pmi_per_month, "2", ".", "thousands_sep"); ?> to your monthly payment.
                    </td>
                </tr>
                <tr valign="top" bgcolor="#FFFF99">
                    <td align="right">Monthly Payment:</td>
                    <td><b><?php echo "\$" . number_format(($monthly_payment + $pmi_per_month), "2", ".", "thousands_sep"); ?></b><br><font>(Principal &amp; Interest, and PMI)</td>
                </tr>
        <?php
            }
        ?>
        <tr valign="top" bgcolor="#CCCCFF">
            <td align="right">&nbsp;</td>
            <td>
                <br>
                <?php
                    $assessed_price          = ($sale_price * .85);
                    $residential_yearly_tax  = ($assessed_price / 1000) * 14;
                    $residential_monthly_tax = $residential_yearly_tax / 12;
                    
                    if ($pmi_per_month == 0)
                        $pmi_text = "";
                    else {
                        $pmi_text = "PMI and ";
                    }
                ?>
                Residential (or Property) Taxes are a little harder to figure out... In Massachusetts, the average resedential tax rate seems to be around $14 per year for every $1,000 of your property's assessed value.
                <br><br>
                Let's say that your property's <i>assessed value</i> is 85% of what you actually paid for it - <?php echo "\$" . number_format($assessed_price, "2", ".", "thousands_sep"); ?>. This would mean that your yearly residential taxes will be around <?php echo "\$" . number_format($residential_yearly_tax, "2", ".", "thousands_sep"); ?>
                This could add <?php echo "\$" . number_format($residential_monthly_tax, "2", ".", "thousands_sep"); ?> to your monthly payment.
            </td>
        </tr>
        <tr valign="top" bgcolor="#9999FF">
            <td align="right">TOTAL Monthly Payment:</td>
            <td><b><?php echo "\$" . number_format(($monthly_payment + $pmi_per_month + $residential_monthly_tax), "2", ".", "thousands_sep"); ?></b><br><font>(including <?php echo $pmi_text; ?> residential tax)</font></td>
        </tr>
<?php    
    }
?>
</table>
</form>
<?php
    // This prints the calculation progress and 
    // the instructions of HOW everything is figured
    // out
    if ($form_complete && $show_progress) {
        $step = 1;
?>
        <br><br>
        <table cellpadding="5" cellspacing="0" border="1" width="100%">
            <tr valign="top">
                <td><b><?php echo $step++; ?></b></td>
                <td>
                    The <b>down payment</b> = The price of the home multiplied by the percentage down divided by 100 (for 5% down becomes 5/100 or 0.05)<br><br>
                    $<?php echo number_format($down_payment,"2",".","thousands_sep"); ?> = $<?php echo number_format($sale_price,"2",".","thousands_sep"); ?> X (<?php echo $down_percent; ?> / 100)
                </td>
            </tr>
            <tr valign="top">
                <td><b><?php echo $step++; ?></b></td>
                <td>
                    The <b>interest rate</b> = The annual interest percentage divided by 100<br><br>
                    <?php echo $annual_interest_rate; ?> = <?php echo $annual_interest_percent; ?>% / 100
                </td>
            </tr>
            <tr valign="top" bgcolor="#cccccc">
                <td colspan="2">
                    The <b>monthly factor</b> = The result of the following formula:
                </td>
            </tr>
            <tr valign="top">
                <td><b><?php echo $step++; ?></b></td>
                <td>
                    The <b>monthly interest rate</b> = The annual interest rate divided by 12 (for the 12 months in a year)<br><br>
                    <?php echo $monthly_interest_rate; ?> = <?php echo $annual_interest_rate; ?> / 12
                </td>
            </tr>
            <tr valign="top">
                <td><b><?php echo $step++; ?></b></td>
                <td>
                    The <b>month term</b> of the loan in months = The number of years you've taken the loan out for times 12<br><br>
                    <?php echo $month_term; ?> Months = <?php echo $year_term; ?> Years X 12
                </td>
            </tr>
            <tr valign="top">
                <td><b><?php echo $step++; ?></b></td>
                <td>
                    The montly payment is figured out using the following formula:<br>
                    Monthly Payment = <?php echo number_format($financing_price, "2", "", ""); ?> * (<?php echo number_format($monthly_interest_rate, "4", "", ""); ?> / (1 - ((1 + <?php echo number_format($monthly_interest_rate, "4", "", ""); ?>)<sup>-(<?php echo $month_term; ?>)</sup>)))
                    <br><br>
                    The <a href="#amortization">amortization</a> breaks down how much of your monthly payment goes towards the bank's interest, and how much goes into paying off the principal of your loan.
                </td>
            </tr>
        </table>
        <br>
<?php
        // Set some base variables
        $principal     = $financing_price;
        $current_month = 1;
        $current_year  = 1;
        // This basically, re-figures out the monthly payment, again.
        $power = -($month_term);
        $denom = pow((1 + $monthly_interest_rate), $power);
        $monthly_payment = $principal * ($monthly_interest_rate / (1 - $denom));
        
        print("<br><br><a name=\"amortization\"></a>Amortization For Monthly Payment: <b>\$" . number_format($monthly_payment, "2", ".", "thousands_sep") . "</b> over " . $year_term . " years<br>\n");
        print("<table cellpadding=\"5\" cellspacing=\"0\" bgcolor=\"#eeeeee\" border=\"1\" width=\"100%\">\n");
        
        // This LEGEND will get reprinted every 12 months
        $legend  = "\t<tr valign=\"top\" bgcolor=\"#cccccc\">\n";
        $legend .= "\t\t<td align=\"right\"><b>Month</b></td>\n";
        $legend .= "\t\t<td align=\"right\"><b>Interest Paid</b></td>\n";
        $legend .= "\t\t<td align=\"right\"><b>Principal Paid</b></td>\n";
        $legend .= "\t\t<td align=\"right\"><b>Remaing Balance</b></td>\n";
        $legend .= "\t</tr>\n";
        
        echo $legend;
                
        // Loop through and get the current month's payments for 
        // the length of the loan 
        while ($current_month <= $month_term) {        
            $interest_paid     = $principal * $monthly_interest_rate;
            $principal_paid    = $monthly_payment - $interest_paid;
            $remaining_balance = $principal - $principal_paid;
            
            $this_year_interest_paid  = $this_year_interest_paid + $interest_paid;
            $this_year_principal_paid = $this_year_principal_paid + $principal_paid;
            
            print("\t<tr valign=\"top\" bgcolor=\"#eeeeee\">\n");
            print("\t\t<td align=\"right\">" . $current_month . "</td>\n");
            print("\t\t<td align=\"right\">\$" . number_format($interest_paid, "2", ".", "thousands_sep") . "</td>\n");
            print("\t\t<td align=\"right\">\$" . number_format($principal_paid, "2", ".", "thousands_sep") . "</td>\n");
            print("\t\t<td align=\"right\">\$" . number_format($remaining_balance, "2", ".", "thousands_sep") . "</td>\n");
            print("\t</tr>\n");
    
            ($current_month % 12) ? $show_legend = FALSE : $show_legend = TRUE;
    
            if ($show_legend) {
                print("\t<tr valign=\"top\" bgcolor=\"#ffffcc\">\n");
                print("\t\t<td colspan=\"4\"><b>Totals for year " . $current_year . "</td>\n");
                print("\t</tr>\n");
                
                $total_spent_this_year = $this_year_interest_paid + $this_year_principal_paid;
                print("\t<tr valign=\"top\" bgcolor=\"#ffffcc\">\n");
                print("\t\t<td>&nbsp;</td>\n");
                print("\t\t<td colspan=\"3\">\n");
                print("\t\t\tYou will spend \$" . number_format($total_spent_this_year, "2", ".", "thousands_sep") . " on your house in year " . $current_year . "<br>\n");
                print("\t\t\t\$" . number_format($this_year_interest_paid, "2", ".", "thousands_sep") . " will go towards INTEREST<br>\n");
                print("\t\t\t\$" . number_format($this_year_principal_paid, "2", ".", "thousands_sep") . " will go towards PRINCIPAL<br>\n");
                print("\t\t</td>\n");
                print("\t</tr>\n");
    
                print("\t<tr valign=\"top\" bgcolor=\"#ffffff\">\n");
                print("\t\t<td colspan=\"4\">&nbsp;<br><br></td>\n");
                print("\t</tr>\n");
                
                $current_year++;
                $this_year_interest_paid  = 0;
                $this_year_principal_paid = 0;
                
                if (($current_month + 6) < $month_term) {
                    echo $legend;
                }
            }
    
            $principal = $remaining_balance;
            $current_month++;
        }
        print("</table>\n");
    }
?>
<br>

<!-- END BODY -->


<?php
    if ($print_footer) {
        print("</body>\n");
        print("</BODY>
</HTML>\n");
    }

?>
