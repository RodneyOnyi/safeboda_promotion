@extends('layouts.app', ['activePage' => 'home'])

@section('content')

    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-primary border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Clients</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{ $clients ?? 0 }}</span>
                  <div class="progress progress-xs mt-3 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="{{ route('users.type','client') }}" class="text-nowrap text-white font-weight-600">View Clients</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-info border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Services Done</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{ $services ?? 0 }}</span>
                  <div class="progress progress-xs mt-3 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="{{ route('service.index') }}" class="text-nowrap text-white font-weight-600">View Services</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-danger border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Payments</h5>
                  <span class="h2 mb-0 text-white">Ksh {{ number_format($payments ?? 0) }}</span>
                  <div class="progress progress-xs mt-3 mb-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:50%"></div>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="{{ route('payments.index') }}" class="text-nowrap text-white font-weight-600">See payments</a>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-8">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">Payments / Clients</h5>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0">
                      <a id="payment_tab" href="" class="nav-link py-2 px-3 active">
                        <span class="d-none d-md-block">Payments</span>
                        <span class="d-md-none">P</span>
                      </a>
                    </li>
                    <li class="nav-item" >
                      <a id="client_tab" href="" class="nav-link py-2 px-3" >
                        <span class="d-none d-md-block">Clients</span>
                        <span class="d-md-none">C</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-payments-dark" class="chart-canvas"></canvas>
                <canvas id="chart-clients-dark" class="chart-canvas" style="display:none"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Stock Alert</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ route('stocks.index') }}" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Stock</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($stocks))
                    @foreach($stocks as $stock)
                    <tr>
                      <th scope="row">{{ $stock->name }}</th>
                      <td>{{ $stock->quantity }}</td>
                      <td></td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

@push('chart_js')
    <script src="{{ asset('custom') }}/js/dashboard.js"></script>
@endpush
