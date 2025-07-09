@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5zM9 7H4l5-5v5zM12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
                                <p class="text-sm text-gray-600">Kelola semua notifikasi Anda</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                {{ $notifikasis->total() }} Total
                            </span>
                            @if ($unreadCount > 0)
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">
                                    {{ $unreadCount }} Belum Dibaca
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                @if ($notifikasis->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach ($notifikasis as $notifikasi)
                            <div class="notification-item p-6 hover:bg-gray-50 transition-colors duration-200 {{ !$notifikasi->is_read ? 'bg-blue-50' : '' }}"
                                data-id="{{ $notifikasi->id }}">
                                <div class="flex items-start space-x-4">
                                    <!-- Status Indicator -->
                                    <div class="flex-shrink-0 mt-1">
                                        <div
                                            class="w-3 h-3 rounded-full {{ !$notifikasi->is_read ? 'bg-blue-500' : 'bg-gray-300' }}">
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                    {{ $notifikasi->judul }}</h3>
                                                <p class="text-gray-600 mb-3">{{ $notifikasi->deskripsi }}</p>
                                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $notifikasi->created_at->diffForHumans() }}
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        {{ $notifikasi->created_at->format('d M Y, H:i') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex items-center space-x-2 ml-4">
                                                @if (!$notifikasi->is_read)
                                                    <button onclick="markAsRead({{ $notifikasi->id }})"
                                                        class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                                        Tandai Dibaca
                                                    </button>
                                                @endif

                                                <button
                                                    onclick="showNotificationDetail({{ $notifikasi->id }}, '{{ addslashes($notifikasi->judul) }}', '{{ addslashes($notifikasi->deskripsi) }}', '{{ $notifikasi->created_at->diffForHumans() }}')"
                                                    class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                                    Detail
                                                </button>

                                                <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors duration-200">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $notifikasis->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-5 5v-5zM9 7H4l5-5v5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada notifikasi</h3>
                        <p class="text-gray-500 mb-6">Anda belum memiliki notifikasi apapun.</p>
                        <a href="{{ route('user.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Notification Detail Modal -->
    <div id="notification-detail-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Detail Notifikasi</h3>
                    <button onclick="closeNotificationDetail()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-3">
                    <div>
                        <h4 id="modal-title" class="font-medium text-gray-900"></h4>
                    </div>
                    <div>
                        <p id="modal-description" class="text-gray-600"></p>
                    </div>
                    <div>
                        <p id="modal-time" class="text-sm text-gray-400"></p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button onclick="closeNotificationDetail()"
                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mark notification as read
        function markAsRead(id) {
            axios.put(`/notifikasi/${id}/read`)
                .then(response => {
                    // Reload page to update UI
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error marking notification as read:', error);
                    alert('Gagal menandai notifikasi sebagai dibaca');
                });
        }

        // Show notification detail
        function showNotificationDetail(id, title, description, timeAgo) {
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-description').textContent = description;
            document.getElementById('modal-time').textContent = timeAgo;
            document.getElementById('notification-detail-modal').classList.remove('hidden');
        }

        // Close notification detail
        function closeNotificationDetail() {
            document.getElementById('notification-detail-modal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('notification-detail-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeNotificationDetail();
            }
        });
    </script>
@endsection
