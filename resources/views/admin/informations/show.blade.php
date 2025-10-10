@extends('layouts.admin')

@section('title', 'Chi tiết thông tin liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết thông tin liên hệ: {{ $information->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.informations.edit', $information) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="{{ route('admin.informations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">ID</th>
                                    <td>{{ $information->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td>{{ $information->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $information->email }}</td>
                                </tr>
                                <tr>
                                    <th>Hotline</th>
                                    <td>{{ $information->hotline ?: 'Chưa có' }}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>{{ $information->website ?: 'Chưa có' }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $information->address ?: 'Chưa có' }}</td>
                                </tr>
                                <tr>
                                    <th>Tọa độ</th>
                                    <td>
                                        @if($information->latitude && $information->longitude)
                                            {{ $information->latitude }}, {{ $information->longitude }}
                                        @else
                                            Chưa xác định
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giờ làm việc</th>
                                    <td>
                                        @php
                                            $workingTime = json_decode($information->working_time, true);
                                            if ($workingTime) {
                                                $days = [
                                                    'monday_friday' => 'Thứ 2 - Thứ 6',
                                                    'saturday' => 'Thứ 7',
                                                    'sunday' => 'Chủ nhật'
                                                ];
                                                $display = '';
                                                foreach ($days as $key => $day) {
                                                    if (isset($workingTime[$key])) {
                                                        if (is_array($workingTime[$key])) {
                                                            $display .= "$day: {$workingTime[$key]['open']} - {$workingTime[$key]['close']}<br>";
                                                        } else {
                                                            $display .= "$day: {$workingTime[$key]}<br>";
                                                        }
                                                    }
                                                }
                                                echo $display ?: 'Chưa có';
                                            } else {
                                                echo 'Chưa có';
                                            }
                                        @endphp
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $information->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $information->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
