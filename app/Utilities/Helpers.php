<?php

use App\Models\Category;
use App\Models\Currency;

class Helper
{

    public static function defaultLogo()
    {
        return asset('frontend/assets/images/logo.svg');
    }

    public static function userProfile()
    {
        return asset('backend/assets/images/avatar/img-1.jpg');
    }

    public static function defaultFavicon()
    {
        return asset('frontend/images/favicon.jpg');
    }

    public static function loader()
    {
        return asset('backend/assets/images/loader.gif');
    }

    public static function DefaultImage()
    {
        return asset('backend/assets/images/default-img.jpg');
    }

    public static function minPrice()
    {
        return floor(\App\Models\Product::min('purchase_price'));
    }

    public static function maxPrice()
    {
        return floor(\App\Models\Product::max('purchase_price'));
    }
    public static function units()
    {
        $x = ['kg', 'pc', 'gms', 'ltrs'];
        return $x;
    }


    // monthly income
    public static function getMonthlySum()
    {
        $year = \Carbon\Carbon::now()->year;
        $month = \Carbon\Carbon::now()->month;
        if ($month < 10) {
            $month = '0' . $month;
        }

        $search = $year . '-' . $month;
        $revenues = \App\Models\Order::where('created_at', 'like', $search . '%')->where('order_status', 'delivered')->get();

        $sum = 0;
        foreach ($revenues as $revenue) {
            $sum += $revenue->total_amount;
        }


        return $sum;
    }

    public static function check_permission($mod_name)
    {

        if ((auth('admin')->user()->id === 1) || in_array($mod_name, json_decode(auth('admin')->user()->staff->role->permissions)) == true) {
            return true;
        }
        return false;
    }



    // get sku combination
    public static function combinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    // Inch to cm
    public static function size_converter($inch)
    {
        $cm = floatval($inch * 2.54);
        return $cm;
    }

    // currency load
    public static function currency_load()
    {
        if (session()->has('system_default_currency_info') == false) {
            session()->put('system_default_currency_info', Currency::find(1));
        }
    }

    public static function currency_converter($amount)
    {
        return format_price(convert_price($amount));
    }

    // price range
    public static function get_price_range($product, $formatted = true)
    {
        $lowest_price = $product->purchase_price;
        $highest_price = $product->purchase_price;
        if (count($product->stocks) > 0) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }

        if ($formatted) {
            if ($lowest_price == $highest_price) {
                return format_price(convert_price($lowest_price));
            } else {
                return format_price(convert_price($lowest_price)) . ' - ' . format_price(convert_price($highest_price));
            }
        } else {
            return $lowest_price . ' - ' . $highest_price;
        }
        //
        //        foreach(json_decode($product->variation) as $key=>$variation){
        //            if($lowest_price > $variation->price){
        //                $lowest_price=$variation->price;
        //            }
        //            if($highest_price < $variation->price){
        //                $highest_price=$variation->price;
        //            }
        //        }

        $lowest_price = convert_price($lowest_price - Helper::get_product_discount($product, $lowest_price));
        $highest_price = convert_price($highest_price - Helper::get_product_discount($product, $highest_price));

        if ($lowest_price == $highest_price) {
            return self::currency_converter($lowest_price);
        }
        return self::currency_converter($lowest_price) . '-' . self::currency_converter($highest_price);
    }

    public static function get_product_discount($product, $price)
    {
        $discount = 0;
        if ($product->discount_type == 'percent') {
            $discount = ($price * $product->discount) / 100;
        } elseif ($product->discount_type == 'amount') {
            $discount = $product->discount;
        }
        return floatval($discount);
    }
}

if (!function_exists('appMode')) {
    function appMode()
    {
        return \Illuminate\Support\Facades\Config::get('app.app_demo');
    }
}

if (!function_exists('demoCheck')) {
    function demoCheck()
    {
        if (appMode()) {
            \Brian2694\Toastr\Facades\Toastr::warning('For the demo version, you cannot change this', 'Failed');
            return true;
        } else {
            return false;
        }
    }
}


//currency symbol
if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        Helper::currency_load();
        if (session()->has('currency_symbol')) {
            $symbol = session('currency_symbol');
        } else {
            $system_default_currency_info = session('system_default_currency_info');
            $symbol = $system_default_currency_info->symbol;
        }

        return $symbol;
    }
}

//Shows Price on page based on low to high with discount
if (!function_exists('home_discounted_price')) {
    function home_discounted_price($product, $formatted = true)
    {
        $price = $product->unit_price;
        $highest_price = $product->purchase_price;

        if (count($product->stocks) > 0) {
            foreach ($product->stocks as $key => $stock) {
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }

        if ($formatted) {
            if ($price == $highest_price) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}

//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        return currency_symbol() . number_format($price, 2);
    }
}
//converts currency to home default currency
if (!function_exists('convert_price')) {
    function convert_price($price)
    {
        Helper::currency_load();
        $system_default_currency_info = session('system_default_currency_info');

        $price = floatval($price) / floatval($system_default_currency_info->exchange_rate);

        if (\Illuminate\Support\Facades\Session::has('currency_exchange_rate')) {
            $exchange = session('currency_exchange_rate');
        } else {
            $exchange = $system_default_currency_info->exchange_rate;
        }

        $price = floatval($price) * floatval($exchange);

        return $price;
    }
}

if (!function_exists('get_settings')) {
    function get_settings($key)
    {
        return \App\Models\Setting::value($key);
    }
}

class PaginationLinks
{

    /* Returns a set of pagination links. The parameters are:
     *
     * $page          - the current page number
     * $numberOfPages - the total number of pages
     * $context       - the amount of context to show around page links - this
     *                  optional parameter defauls to 1
     * $linkFormat    - the format to be used for links to other pages - this
     *                  parameter is passed to sprintf, with the page number as a
     *                  second and third parameter. This optional parameter
     *                  defaults to creating an HTML link with the page number as
     *                  a GET parameter.
     * $pageFormat    - the format to be used for the current page - this
     *                  parameter is passed to sprintf, with the page number as a
     *                  second and third parameter. This optional parameter
     *                  defaults to creating an HTML span containing the page
     *                  number.
     * $ellipsis      - the text to be used where pages are omitted - this
     *                  optional parameter defaults to an ellipsis ('...')
     */
    public static function create(
        $page,
        $numberOfPages,
        $context    = 1,
        $linkFormat = '<a href="javascript:void(0)" data-page="%d" >%d</a>',
        $pageFormat = '<a href="javascript:void(0)" class="active-page">%d</a>',
        $ellipsis   = '&hellip;'
    ) {

        // create the list of ranges
        $ranges = array(array(1, 1 + $context));
        self::mergeRanges($ranges, $page   - $context, $page + $context);
        self::mergeRanges($ranges, $numberOfPages - $context, $numberOfPages);

        // initialise the list of links
        $links = array();

        // loop over the ranges
        foreach ($ranges as $range) {

            // if there are preceeding links, append the ellipsis
            if (count($links) > 0) $links[] = $ellipsis;

            // merge in the new links
            $links =
                array_merge(
                    $links,
                    self::createLinks($range, $page, $linkFormat, $pageFormat)
                );
        }

        // return the links
        return implode(' ', $links);
    }

    /* Merges a new range into a list of ranges, combining neighbouring ranges.
     * The parameters are:
     *
     * $ranges - the list of ranges
     * $start  - the start of the new range
     * $end    - the end of the new range
     */
    private static function mergeRanges(&$ranges, $start, $end)
    {

        // determine the end of the previous range
        $endOfPreviousRange = &$ranges[count($ranges) - 1][1];

        // extend the previous range or add a new range as necessary
        if ($start <= $endOfPreviousRange + 1) {
            $endOfPreviousRange = $end;
        } else {
            $ranges[] = array($start, $end);
        }
    }

    /* Create the links for a range. The parameters are:
     *
     * $range      - the range
     * $page       - the current page
     * $linkFormat - the format for links
     * $pageFormat - the format for the current page
     */
    private static function createLinks($range, $page, $linkFormat, $pageFormat)
    {

        // initialise the list of links
        $links = array();

        // loop over the pages, adding their links to the list of links
        for ($index = $range[0]; $index <= $range[1]; $index++) {
            $links[] =
                sprintf(
                    ($index == $page ? $pageFormat : $linkFormat),
                    $index,
                    $index
                );
        }

        // return the array of links
        return $links;
    }
}
