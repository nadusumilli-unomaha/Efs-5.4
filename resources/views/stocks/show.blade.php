<!--Extending the main header document in the views folder app1.blade.php-->
@extends('layouts/app')
<!--Creating the section for the present page by using the navbar section.-->
@section('content')
    <!--The main document section starts here.-->
    <div class="container">
        <h1>{{ $stock->customer->name }}'s {{ $stock->name }} Stock Details</h1>
        <a class="btn btn-primary pull-right" style="margin: 10px 10px 10px 10px;" href="{{ URL::previous() }}">Go Back</a>
        <!--Table that prints out the Complete stock information.-->
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr class="bg-info">
            <tr>
                <td>Stock Symbol</td>
                <td><?php echo ($stock['symbol']); ?></td>
            </tr>
            <tr>
                <td>Stock Name</td>
                <td><?php echo ($stock['name']); ?></td>
            </tr>
            <tr>
                <td>Number of Shares</td>
                <td><?php echo ($stock['shares']); ?></td>
            </tr>
            <tr>
                <td>Purchase Price </td>
                <td><?php echo ($stock['purchase_price']); ?>$</td>
            </tr>
            <tr>
                <td>Date Purchased</td>
                <td><?php echo ($stock['purchased']); ?></td>
            </tr>
            <tr>
                <!-- Using the in-built php functions to pull the stock information from the website and use them to display the latest price. -->
                <td>Latest Stock Price</td>
                <td>
                    <?php
                        $URL="http://finance.google.com/finance/info?client=ig&q=" . $stock->symbol;
                        $file = fopen("$URL", "r");
                        $r = "";
                        do {
                        $data = fread($file, 500);
                        $r .= $data;
                        } while (strlen($data) != 0);

                        $json = str_replace("\n", "", $r);
                        $data = substr($json, 4, strlen($json) - 5);
                        $json_output = json_decode($data, true);
                        $currentStockVal = "\n" . $json_output['l'];
                        echo $currentStockVal;
                    ?>$                        
                </td>
            </tr>
            <tr>
                <!-- Doing some Calculation from the values obtained above to provide a detailed stock information. -->
                <?php $var = round(floatval($stock['shares']) * floatval($stock['purchase_price']),2); ?>
                <td>Total Stock Value</td>
                <td><?php echo ($var); ?>$</td>
            </tr>
            <tr>
                <!-- Doing some Calculation from the values obtained above to provide a detailed stock information. -->
                <?php $LatestStockValue = round(floatval($stock['shares']) * floatval($currentStockVal),2); 
                      $GainorLoss = floatval($LatestStockValue) - floatval($var);?>
                <td>Latest Stock Value</td>
                <td><?php echo ($LatestStockValue); ?>$</td>
            </tr>
            <tr>
                <!-- Doing some Calculation from the values obtained above to provide a detailed stock information. -->
                <td>Gain Or Loss</td>
                <td><?php echo round($GainorLoss,2) ?>$</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop
