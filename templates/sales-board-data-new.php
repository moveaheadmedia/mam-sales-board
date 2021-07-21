<?php

if (!isset($_GET['action'])) {
    die('No Action!');
}
if ($_GET['action'] == 'users') {
    $csv = new \ParseCsv\Csv();
    echo file_get_contents('https://docs.google.com/spreadsheets/d/1IkufcwjOhDXW8xC1ntCjVjcJs9yoiM9kW57SsiRNNpA/gviz/tq?tqx=out:html&sheet=First%20Table');
}
if ($_GET['action'] == 'second') {
    $csv = new \ParseCsv\Csv();
    echo file_get_contents('https://docs.google.com/spreadsheets/d/1IkufcwjOhDXW8xC1ntCjVjcJs9yoiM9kW57SsiRNNpA/gviz/tq?tqx=out:html&sheet=Second%20Part');
}

if ($_GET['action'] == 'country') {
    $sheetURL1 = 'https://docs.google.com/spreadsheets/d/1IkufcwjOhDXW8xC1ntCjVjcJs9yoiM9kW57SsiRNNpA/gviz/tq?tqx=out:csv&sheet=First%20Table';
    $file_name1 = 'data1.csv';
    if (file_put_contents(MSB_PATH . 'data/' . $file_name1, file_get_contents($sheetURL1))) {
        $csv = new \ParseCsv\Csv();
        $csv->parseFile(MSB_PATH . 'data/' . $file_name1);
        $data = $csv->data;

        $table = array();
        $global = array();
        $global['Team'] = 'Global';
        $global['New Recurring Target'] = get_new_recurring_target($data, 'Global', 'AUD');
        $global['New Recurring Collected'] = get_new_recurring_collected($data, 'Global', 'AUD');
        $global['%'] = get_new_recurring_precentage($data, 'Global', 'AUD');
        $global['Monthly Recurring Target'] = get_monthly_recurring_target($data, 'Global', 'AUD');
        $global['Monthly Recurring Collected'] = get_monthly_recurring_collected($data, 'Global', 'AUD');
        $global['% '] = get_monthly_recurring_percentage($data, 'Global', 'AUD');
        $global['Singles'] = get_singles($data, 'Global', 'AUD');
        $global['Total Money in'] = get_total_in($data, 'Global', 'AUD');
        $table[] = $global;

        $uk = array();
        $uk['Team'] = 'UK';
        $uk['New Recurring Target'] = get_new_recurring_target($data, 'UK', 'GBP');
        $uk['New Recurring Collected'] = get_new_recurring_collected($data, 'UK', 'GBP');
        $uk['%'] = get_new_recurring_precentage($data, 'UK', 'GBP');
        $uk['Monthly Recurring Target'] = get_monthly_recurring_target($data, 'UK', 'GBP');
        $uk['Monthly Recurring Collected'] = get_monthly_recurring_collected($data, 'UK', 'GBP');
        $uk['% '] = get_monthly_recurring_percentage($data, 'UK', 'GBP');
        $uk['Singles'] = get_singles($data, 'UK', 'GBP');
        $uk['Total Money in'] = get_total_in($data, 'UK', 'GBP');
        $table[] = $uk;

        $th = array();
        $th['Team'] = 'TH';
        $th['New Recurring Target'] = get_new_recurring_target($data, 'TH', 'THB');
        $th['New Recurring Collected'] = get_new_recurring_collected($data, 'TH', 'THB');
        $th['%'] = get_new_recurring_precentage($data, 'TH', 'THB');
        $th['Monthly Recurring Target'] = get_monthly_recurring_target($data, 'TH', 'THB');
        $th['Monthly Recurring Collected'] = get_monthly_recurring_collected($data, 'TH', 'THB');
        $th['% '] = get_monthly_recurring_percentage($data, 'TH', 'THB');
        $th['Singles'] = get_singles($data, 'TH', 'THB');
        $th['Total Money in'] = get_total_in($data, 'TH', 'THB');
        $table[] = $th;

        $au = array();
        $au['Team'] = 'AU';
        $au['New Recurring Target'] = get_new_recurring_target($data, 'AU', 'AUD');
        $au['New Recurring Collected'] = get_new_recurring_collected($data, 'AU', 'AUD');
        $au['%'] = get_new_recurring_precentage($data, 'AU', 'AUD');
        $au['Monthly Recurring Target'] = get_monthly_recurring_target($data, 'AU', 'AUD');
        $au['Monthly Recurring Collected'] = get_monthly_recurring_collected($data, 'AU', 'AUD');
        $au['% '] = get_monthly_recurring_percentage($data, 'AU', 'AUD');
        $au['Singles'] = get_singles($data, 'AU', 'AUD');
        $au['Total Money in'] = get_total_in($data, 'AU', 'AUD');
        $table[] = $au;

        $mam = array();
        $mam['Team'] = 'MAM TOTAL';
        $mam['New Recurring Target'] = get_new_recurring_target($data);
        $mam['New Recurring Collected'] = get_new_recurring_collected($data);
        $mam['%'] = get_new_recurring_precentage($data);
        $mam['Monthly Recurring Target'] = get_monthly_recurring_target($data);
        $mam['Monthly Recurring Collected'] = get_monthly_recurring_collected($data);
        $mam['% '] = get_monthly_recurring_percentage($data);
        $mam['Singles'] = get_singles($data);
        $mam['Total Money in'] = get_total_in($data);
        $table[] = $mam;

        foreach ($table as $row) {
            echo '<tr>';
            foreach ($row as $column) {
                echo '<td>' . $column . '</td>';
            }
            echo '</tr>';
        }
    }
    update_sheet_total($data);
}

function get_new_recurring_target($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['New Recurring Target'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}

function get_new_recurring_collected($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['New Recurring Collected'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}

function get_new_recurring_precentage($data, $country = 'All', $currency = 'AUD', $number = false)
{
    if ($number) {
        return get_new_recurring_collected($data, $country, $currency, true) / get_new_recurring_target($data, $country, $currency, true);
    }
    return round(get_new_recurring_collected($data, $country, $currency, true) / get_new_recurring_target($data, $country, $currency, true) * 100) . '%';

}

function get_monthly_recurring_target($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['Monthly Recurring Target'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}

function get_monthly_recurring_collected($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['Monthly Recurring Collected'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}

function get_monthly_recurring_percentage($data, $country = 'All', $currency = 'AUD', $number = false)
{
    if ($number) {
        return get_monthly_recurring_collected($data, $country, $currency, true) / get_monthly_recurring_target($data, $country, $currency, true);
    }
    return round(get_monthly_recurring_collected($data, $country, $currency, true) / get_monthly_recurring_target($data, $country, $currency, true) * 100) . '%';
}

function get_singles($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['Singles'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}

function get_total_in($data, $country = 'All', $currency = 'AUD', $number = false)
{
    $total = 0;
    foreach ($data as $row) {
        if ($country) {
            if ($country != 'All' && $row['Country'] != $country) {
                continue;
            }
            $total = $total + convert_to_currency($row['Total Money in'], $row['Country'], $currency);
        }
    }
    if ($number) {
        return $total;
    }
    return $currency . ' ' . number_format($total);
}


function convert_to_currency($amount, $from, $to = null)
{
    if ($from == 'Global' || $from == 'AU') {
        $from = 'AUD';
    }
    if ($from == 'UK') {
        $from = 'GBP';
    }
    if ($from == 'TH') {
        $from = 'THB';
    }
    if ($to == null) {
        $to = 'AUD';
    }
    $rates = auto_calc_rates();
    return getAmount($amount) * $rates[$from . '_' . $to];

}

function auto_calc_rates($aud = 23, $gbp = 40)
{
    $rates = array();
    $rates['AUD_THB'] = $aud;
    $rates['THB_AUD'] = 1 / $aud;
    $rates['GBP_THB'] = $gbp;
    $rates['THB_GBP'] = 1 / $gbp;
    $rates['GBP_AUD'] = $gbp / $aud;
    $rates['AUD_GBP'] = $aud / $gbp;

    $rates['AUD_AUD'] = 1;
    $rates['GBP_GBP'] = 1;
    $rates['THB_THB'] = 1;
    return $rates;
}

function getAmount($money)
{
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

    return (float)str_replace(',', '.', $removedThousandSeparator);
}

function update_sheet_total($data)
{
    $spreadsheetId = '1IkufcwjOhDXW8xC1ntCjVjcJs9yoiM9kW57SsiRNNpA';
    //$spreadsheetId = '1y-lpfMpSpoUxSK-KNtyjtrc2sdwaq4xESqt7PyeJTck';
    $range1 = 'Second Part!D2';
    $range2 = 'Second Part!G2';
    $new_collected = round(get_new_recurring_collected($data, 'All', 'AUD', true));
    $monthly_recurring_target = round(get_monthly_recurring_target($data, 'All', 'AUD', true));
    $client = mam_getClient();
    $service = new Google_Service_Sheets($client);
    $body = new Google_Service_Sheets_ValueRange(json_decode('{"values":[["'.$new_collected.'"]]}', true));
    $service->spreadsheets_values->update($spreadsheetId, $range1, $body, ['valueInputOption' => 'USER_ENTERED']);

    $body = new Google_Service_Sheets_ValueRange(json_decode('{"values":[["'.($new_collected + $monthly_recurring_target).'"]]}', true));
    $service->spreadsheets_values->update($spreadsheetId, $range2, $body, ['valueInputOption' => 'USER_ENTERED']);
}