@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="mb-4">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
            <small>Measure How Fast You’re Growing Monthly Recurring Revenue.</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12 ">
        <div class="card">
            <div class="card-body">
                <h6>Available Balance</h6>
                <h3 class="pt-3"><i class="fa fa-bitcoin"></i> <span class="counter">136.25402</span></h3>
                <h5>$1,25,451.23</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 ">
        <div class="card">
            <div class="card-body">
                <h6>Total Investment</h6>
                <h3 class="pt-3"><i class="fa fa-bitcoin"></i> <span class="counter">251.25402</span></h3>
                <h5>$3,80,451.00</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 ">
        <div class="card">
            <div class="card-body">
                <h6>Profit in Bitcoin</h6>
                <h3 class="pt-3"><i class="fa fa-bitcoin"></i> <span class="counter">32.96512</span></h3>
                <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 ">
        <div class="card">
            <div class="card-body">
                <h6>Profit in USD</h6>
                <h3 class="pt-3"><i class="fa fa-dollar"></i> <span class="counter">98,532.02</span></h3>
                <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix row-deck">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Crypto Statistics</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-md-flex justify-content-between">
                    <div>
                        <h5 class="mb-1">BTC $<span class="counter">12,159.32</span></h5>
                        <span class="text-muted">Note Enim omittam, ex quo dictas complectitur<a href="#">View more</a></span>
                    </div>
                    <div>
                        <div class="selectgroup w250">
                            <label class="selectgroup-item">
                                <input type="radio" name="intensity" value="low" class="selectgroup-input" checked="">
                                <span class="selectgroup-button">7 Day</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="intensity" value="medium" class="selectgroup-input">
                                <span class="selectgroup-button">15 Day</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="intensity" value="high" class="selectgroup-input">
                                <span class="selectgroup-button">30 Day</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="apex-Crypto_statistics"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Transaction History</h2>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-donut" style="height: 15rem"></div>
            </div>
            <table class="table card-table">
                <tbody>
                    <tr>
                        <td class="width45"><span class="avatar avatar-green"><i class="fa fa-check"></i></span></td>
                        <td>
                            <p class="mb-0">Payment from #1598</p>
                            <span class="text-muted font-13">Feb 21, 2019, 3:30pm</span>
                        </td>
                        <td class="text-right">
                            <p class="mb-0">$300</p>
                            <span class="text-success font-13">Done</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="width45"><span class="avatar avatar-green"><i class="fa fa-truck"></i></span></td>
                        <td>
                            <p class="mb-0">Process to #85236</p>
                            <span class="text-muted font-13">March 14, 2019, 2:30pm</span>
                        </td>
                        <td class="text-right">
                            <p class="mb-0">$300</p>
                            <span class="text-success font-13">Faild</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="width45"><span class="avatar avatar-orange"><i class="fa fa-angle-left"></i></span></td>
                        <td>
                            <p class="mb-0">Process refund #4568</p>
                            <span class="text-muted font-13">March 18, 2019, 6:30pm</span>
                        </td>
                        <td class="text-right">
                            <p class="mb-0">$300</p>
                            <span class="text-success font-13">Done</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="width45"><span class="avatar avatar-red"><i class="fa fa-cc-visa"></i></span></td>
                        <td>
                            <p class="mb-0">Payment failed from #32658</p>
                            <span class="text-muted font-13">April 27, 2019, 3:48pm</span>
                        </td>
                        <td class="text-right">
                            <p class="mb-0">$300</p>
                            <span class="text-danger font-13">Declined</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row clearfix row-deck">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">ICO Token</label>
                            <input type="email" class="form-control" placeholder="23097">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">ETH</label>
                            <input type="email" class="form-control" placeholder="2">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Select</label>
                            <select class="custom-select">
                                <option selected="">ETH</option>
                                <option value="1">BTC</option>
                                <option value="2">LTC</option>
                                <option value="3">USDT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Wallet address</label>
                            <input type="email" class="form-control" placeholder="0OXD38D9EEB5B93E1D3862727635E9">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Buy now</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">ICO Token</label>
                            <input type="email" class="form-control" placeholder="23097">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">ETH</label>
                            <input type="email" class="form-control" placeholder="2">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Select</label>
                            <select class="custom-select">
                                <option selected="">ETH</option>
                                <option value="1">BTC</option>
                                <option value="2">LTC</option>
                                <option value="3">USDT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Wallet address</label>
                            <input type="email" class="form-control" placeholder="0OXD38D9EEB5B93E1D3862727635E9">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Sale now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Current Active Trades</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-sm-flex mb-3">
                    <div class="top_counter mb-2 mr-4">
                        <div class="icon bg-green"><i class="fa fa-area-chart"></i> </div>
                        <div class="content">
                            <span>Buy</span>
                            <h5 class="number mb-0">$2,02,150.52</h5>
                        </div>
                    </div>
                    <div class="top_counter mb-2">
                        <div class="icon bg-red"><i class="fa fa-area-chart"></i> </div>
                        <div class="content">
                            <span>Sale</span>
                            <h5 class="number mb-0">$92,150.00</h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped mb-0 table-vcenter">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Currency</th>
                                <th>Balance</th>
                                <th>Buying Rate</th>
                                <th>Curre Rate</th>
                                <th>Status</th>
                                <th>Last Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>BTC</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$209.98</td>
                                <td>$521.32 <i class="fa fa-sort-down"></i></td>
                                <td>$251.00</td>
                                <td><button type="submit" class="btn btn-danger btn-sm">Close</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>ETH</td>
                                <td>54,124.25</td>
                                <td>$205.11</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-asc"></i></td>
                                <td>$251.00</td>
                                <td><button type="submit" class="btn btn-danger btn-sm">Close</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>XRP</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-asc"></i></td>
                                <td>$251.00</td>
                                <td><button type="submit" class="btn btn-danger btn-sm">Close</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>BCH</td>
                                <td>54,124.25</td>
                                <td>$880.41</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-down"></i></td>
                                <td>$251.00</td>
                                <td><button type="submit" class="btn btn-success btn-sm">Open</button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>XLM</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-down"></i></td>
                                <td>$105.00</td>
                                <td><button type="submit" class="btn btn-success btn-sm">Open</button></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>EOS</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-asc"></i></td>
                                <td>$251.00</td>
                                <td><button type="submit" class="btn btn-danger btn-sm">Close</button></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>LTC</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$209.98</td>
                                <td>$521.65 <i class="fa fa-sort-asc"></i></td>
                                <td>$102.00</td>
                                <td><button type="submit" class="btn btn-success btn-sm">Open</button></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>ADA</td>
                                <td>54,124.25</td>
                                <td>$205.41</td>
                                <td>$65.98</td>
                                <td>$521.65 <i class="fa fa-sort-asc"></i></td>
                                <td>$250.00</td>
                                <td><button type="submit" class="btn btn-danger btn-sm">Close</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
