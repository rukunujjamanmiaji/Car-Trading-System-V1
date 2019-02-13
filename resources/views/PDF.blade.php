@extends('layouts.admin')
<?php
use App\DataLayer\CarTradingDBAccess;
$DBAAccess = new CarTradingDBAccess();
?>
@section('content')
    <h1 style="text-align:center">Nirapod.Bangla Solutions Limited</h1>

    <style>
        .height {
            min-height: 200px;
        }

        .icon {
            font-size: 47px;
            color: #5CB85C;
        }

        .iconbig {
            font-size: 77px;
            color: #5CB85C;
        }

        td {
            font-size: 20px;
        }

        .table > tbody > tr > .emptyrow {
            border-top: none;
        }

        .table > thead > tr > .emptyrow {
            border-bottom: none;
        }

        .table > tbody > tr > .highrow {
            border-top: 3px solid;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="text-center">
                    <h2>Quotation for Invoice No: <strong>{{ $quotation->invoiceno }}</strong></h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-lg-4 pull-left">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Customer Details</div>
                            <div class="panel-body">
                                <strong>
                                    Customer Name:
                                </strong>
                                {{ $allorders->CustomerName }}
                                <br>

                                <strong>
                                    Customer Email:
                                </strong>
                                {{ $allorders->CustomerEmail }}
                                <br>

                                <strong>
                                    Contact Number:
                                </strong>
                                {{ $allorders->CustomerContactNumber }}
                                <br>

                                <strong>
                                    Address:
                                </strong>
                                {{ $allorders->CustomerAddress }}
                                <br/>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Quotation Details</div>
                            <div class="panel-body">
                                <strong>Model Name:</strong>
                                {{ $allorders->allmodels->ModelName }}
                                <br>

                                <?php
                                $countryname = $DBAAccess->FindCountryNameByBrandId($allorders->allmodels->BrandID);
                                $companyname = $DBAAccess->FindCompanyNameByBrandId($allorders->allmodels->BrandID);
                                ?>
                                <strong>Company Name:</strong> {{ $companyname }}<br>
                                <strong>Country:</strong> {{ $countryname }}<br>
                                <strong>Year Of Release:</strong> {{ $allorders->allmodels->YearOfRelease }}<br>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Shipping Address</div>
                            <div class="panel-body">

                                <strong>Name:</strong>{{ $allorders->CustomerName }}<br>
                                <strong>Country: </strong>

                                <?php
                                $seaport = $DBAAccess->FindCountryBySeaPortId($allorders->SeaPortID);
                                ?>

                                @if($allorders->OtherCountryName!=null)
                                    {{ $allorders->OtherCountryName }}<br>
                                    <strong>Port: </strong> {{ $allorders->OtherSeaport }}
                                @else
                                    {{ $seaport->countries->CountryName }}<br>
                                    <strong>Port: </strong> {{ $seaport->SerPortName }}
                                @endif

                                <strong>Address: </strong> {{ $allorders->DeliveryAddress }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center"><strong>Quotation summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-center"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $allorders->allmodels->ModelName }}</td>
                                    <td class="text-center">${{ $quotation->BasePrice }} USD</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">${{ $quotation->BasePrice }} USD</td>
                                </tr>

                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-center">$ {{ $quotation->BasePrice }} USD</td>
                                </tr>
                                <tr>

                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping Cost</strong></td>
                                    <td class="emptyrow text-center">$ {{ $quotation->SeaPortCost }} USD</td>
                                </tr>

                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shifting Cost</strong></td>
                                    <td class="emptyrow text-center">${{ $quotation->ShiftingCost }} USD</td>
                                </tr>

                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>VAT</strong></td>
                                    <td class="emptyrow text-center">$ {{ $quotation->VAT }} USD</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-center">$ {{ $totalprice }} USD</td>
                                </tr>

                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Amount In Words</strong></td>
                                    <td class="emptyrow text-center"> {{ $amountinword }} USD</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

                <h3 class="text-left"><strong>[Payee Account]</strong></h3>
                <h2 class="text-left">BANK NAME： NRB COMMERCIAL BANK LIMITED</h2>
                <h2 class="text-left">BRANCH NAME: HEMAYETPUR BRANCH</h2>
                <h2 class="text-left">ACCOUNT NUMBER： 010733300000362</h2>
                <h2 class="text-left">ACCOUNT NAME： NIRAPOD.BANGLA SOLUTIONS LIMITED</h2>
            </div>
            <div class="col-md-8">

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Car Description</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td class="text-center"><strong>Properties</strong></td>
                                <td class="text-center"><strong>Value</strong></td>
                                <td class="text-center"><strong>Properties</strong></td>
                                <td class="text-center"><strong>Value</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">Model Name</td>
                                <td class="text-center">@Model.ModelName</td>
                                <td class="text-center">Length</td>
                                <td class="text-center">@Model.Length</td>
                            </tr>

                            <tr>
                                <td class="text-center">Country</td>
                                <td class="text-center">@Model.Country</td>
                                <td class="text-center">
                                    Width
                                </td>
                                <td class="text-center">@Model.Width</td>

                            </tr>
                            <tr>

                                <td class="text-center">Year Of Release</td>
                                <td class="text-center">@Model.YearOfRelease</td>
                                <td class="text-center">
                                    Height
                                </td>
                                <td class="text-center">@Model.Height</td>
                            </tr>

                            <tr>
                                <td class="text-center">Engine Type</td>
                                <td class="text-center">@Model.EngineType</td>
                                <td class="text-center">Wheelbase</td>
                                <td class="text-center">@Model.Wheelbase</td>
                            </tr>

                            <tr>
                                <td class="text-center">Displacement</td>
                                <td class="text-center">@Model.Displacement</td>
                                <td class="text-center">Gross Weight</td>
                                <td class="text-center">@Model.GrossWeight</td>
                            </tr>
                            <tr>
                                <td class="text-center">Power</td>
                                <td class="text-center">@Model.Power</td>
                                <td class="text-center">
                                    Seating Capacity
                                </td>
                                <td class="text-center">@Model.SeatingCapacity</td>
                            </tr>

                            <tr>
                                <td class="text-center">Torque</td>
                                <td class="text-center">@Model.Torque</td>
                                <td class="text-center">Wheel Type</td>
                                <td class="text-center">@Model.WheelType</td>
                            </tr>

                            <tr>
                                <td class="text-center">Mileage</td>
                                <td class="text-center">N/A</td>
                                <td class="text-center">
                                    Front Tyre Size
                                </td>
                                <td class="text-center">@Model.FrontTyreSize</td>
                            </tr>

                            <tr>
                                <td class="text-center">Transmission</td>
                                <td class="text-center">@Model.Transmission</td>
                                <td class="text-center">Rear Tyre Size</td>
                                <td class="text-center">@Model.RearTyreSize</td>
                            </tr>

                            <tr>
                                <td class="text-center">Drive Train</td>
                                <td class="text-center">@Model.DriveTrain</td>
                                <td class="text-center">Front Brake Type</td>
                                <td class="text-center">@Model.FrontBrakeType</td>
                            </tr>

                            <tr>
                                <td class="text-center">Number of Gears</td>
                                <td class="text-center">@Model.NumberOfGears</td>
                                <td class="text-center">Rear Brake Type</td>
                                <td class="text-center">@Model.RearBrakeType</td>
                            </tr>

                            <tr>
                                <td class="text-center">Number of Cylinders</td>
                                <td class="text-center">@Model.NumberofCylinders</td>
                                <td class="text-center">Front Suspension</td>
                                <td class="text-center">@Model.FrontSuspension</td>
                            </tr>

                            <tr>
                                <td class="text-center">Performance 0 To 100 Kmph</td>
                                <td class="text-center">@Model.Performance0To100Kmph</td>
                                <td class="text-center">Rear Suspension</td>
                                <td class="text-center">@Model.RearSuspension</td>
                            </tr>

                            <tr>
                                <td class="text-center">Maximum Speed</td>
                                <td class="text-center">@Model.MaximumSpeed</td>
                                <td class="text-center">Power Steering</td>
                                <td class="text-center">@Model.PowerSteering</td>
                            </tr>

                            <tr>
                                <td class="text-center">Fuel Tank Capacity</td>
                                <td class="text-center">@Model.FuelTankCapacity</td>
                                <td class="text-center">Steering Type</td>
                                <td class="text-center">@Model.SteeringType</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

