@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-normal mb-1">Insights & Reports</h4>
            <span class="text-muted small">Analisis Kinerja & Operasional dengan Multi-Algoritma</span>
        </div>
        <div class="btn-group">
            <button class="btn btn-sm btn-gh-default active">Bulan Ini</button>
            <button class="btn btn-sm btn-gh-default">Quarterly</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <nav class="nav flex-column mb-4 sticky-top" style="top: 20px; z-index: 1;">
                <div class="small text-muted fw-bold mb-2 ms-3 text-uppercase">Jump To</div>

                <a class="nav-link text-dark bg-white border rounded mb-2 shadow-sm" href="#financial-stats">
                    <i class="bi bi-cash-coin me-2 text-success"></i> Financial Stats
                </a>
                <a class="nav-link text-dark bg-white border rounded mb-2 shadow-sm" href="#attendance-pulse">
                    <i class="bi bi-graph-up me-2 text-primary"></i> Attendance Pulse
                </a>
                <a class="nav-link text-dark bg-white border rounded mb-2 shadow-sm" href="#saw-analysis">
                    <i class="bi bi-trophy me-2 text-warning"></i> SAW Ranking
                </a>
                <a class="nav-link text-dark bg-white border rounded mb-2 shadow-sm" href="#topsis-analysis">
                    <i class="bi bi-bar-chart-steps me-2 text-info"></i> TOPSIS Analysis
                </a>
            </nav>
        </div>

        <div class="col-md-9">

            <div id="financial-stats" class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="gh-box p-3 h-100 border-start border-4 border-success">
                        <div class="text-muted small text-uppercase fw-bold mb-1">Total Payroll (YTD)</div>
                        <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalSalary, 0, ',', '.') }}</h3>
                        <div class="text-muted small mt-2">
                            <i class="bi bi-receipt me-1"></i> {{ $totalPayrollCount }} Transaksi gaji diproses
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="gh-box p-3 h-100 border-start border-4 border-warning">
                        <div class="text-muted small text-uppercase fw-bold mb-1">Leave Requests</div>
                        <div class="d-flex align-items-center mt-2">
                            <div class="me-4">
                                <h3 class="fw-bold mb-0">{{ $approvedLeaves }}</h3>
                                <span class="small text-success">Approved</span>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-muted">{{ $pendingLeaves }}</h3>
                                <span class="small text-warning">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="attendance-pulse" class="gh-box p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Traffic Kehadiran (30 Hari)</h5>
                    <span class="badge border bg-light text-muted">Real-time Data</span>
                </div>

                @if (empty($chartData))
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Belum ada data absensi yang tercatat.
                    </div>
                @else
                    <div class="d-flex align-items-end justify-content-between px-2" style="height: 200px; gap: 4px;">
                        @foreach ($chartData as $data)
                            <div class="d-flex flex-column align-items-center justify-content-end h-100"
                                style="width: 100%;">
                                <div class="bg-primary rounded-top" title="{{ $data['date'] }}: {{ $data['count'] }} Hadir"
                                    style="width: 100%; height: {{ $data['percentage'] == 0 ? 2 : $data['percentage'] }}%; opacity: 0.8; min-height: 4px;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between text-muted small mt-2 border-top pt-2">
                        <span>{{ $chartData[0]['date'] ?? 'Start' }}</span>
                        <span>{{ end($chartData)['date'] ?? 'End' }}</span>
                    </div>
                @endif
            </div>

            <div id="saw-analysis" class="gh-box mb-4">
                <div class="gh-box-header py-3 bg-light border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0"><i class="bi bi-award me-2 text-warning"></i>Metode SAW</h6>
                            <span class="small text-muted">Simple Additive Weighting Ranking</span>
                        </div>
                        <span class="badge bg-warning text-dark">Top 5</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light text-secondary small">
                            <tr>
                                <th class="ps-4">Rank</th>
                                <th>Karyawan</th>
                                <th>Kehadiran (70%)</th>
                                <th>Loyalitas (30%)</th>
                                <th>Final Score</th>
                                <th class="text-end pe-4">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topPerformersSAW as $index => $performer)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">#{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $performer->name }}</div>
                                        <div class="small text-muted">{{ $performer->position }}</div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge border fw-normal bg-light">{{ $performer->attendance_score }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge border fw-normal bg-light">{{ $performer->loyalty_score }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-5 text-dark">{{ $performer->final_score }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span
                                            class="badge border rounded-pill {{ $performer->grade == 'Top Performer' ? 'bg-success bg-opacity-10 text-success border-success' : 'bg-light text-dark' }}">
                                            {{ $performer->grade }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Data belum cukup.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="topsis-analysis" class="gh-box mb-4">
                <div class="gh-box-header py-3 bg-light border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-steps me-2 text-info"></i>Metode TOPSIS</h6>
                            <span class="small text-muted">Technique for Order of Preference by Similarity to Ideal
                                Solution</span>
                        </div>
                        <span class="badge bg-info text-dark">Recommendation</span>
                    </div>
                </div>
                <div class="gh-box-body">
                    <p class="small text-muted mb-3">
                        TOPSIS menghitung jarak karyawan terbaik terhadap <strong>Solusi Ideal Positif</strong> (Kriteria
                        Max) dan terjauh dari <strong>Solusi Ideal Negatif</strong>. Nilai 1.0000 adalah nilai sempurna.
                    </p>
                    <div class="table-responsive border rounded">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light text-secondary small">
                                <tr>
                                    <th class="ps-4">Rank</th>
                                    <th>Karyawan</th>
                                    <th>Jabatan</th>
                                    <th class="text-end pe-4">Nilai Preferensi (V)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topPerformersTOPSIS as $index => $performer)
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $performer->name }}</div>
                                        </td>
                                        <td><span class="small text-muted">{{ $performer->position }}</span></td>
                                        <td class="text-end pe-4">
                                            <span class="fw-bold text-info fs-5">{{ $performer->preference }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Data belum cukup.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="gh-box-footer bg-light p-2 small text-muted border-top text-center">
                    Jika Ranking SAW dan TOPSIS berbeda, disarankan menggunakan TOPSIS untuk keputusan strategis.
                </div>
            </div>

        </div>
    </div>
@endsection
