@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Kelola User
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Ini adalah halaman untuk menambah, mengedit, dan menghapus user</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg flex items-center gap-2">
            <i class="ph ph-user-plus text-lg"></i>
            Tambah User Baru
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/20 dark:border-green-800 dark:text-green-400">
            <div class="flex items-center gap-2">
                <i class="ph ph-check-circle text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @elseif (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg dark:bg-red-900/20 dark:border-red-800 dark:text-red-400">
            <div class="flex items-center gap-2">
                <i class="ph ph-warning-circle text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 dark:border-gray-600">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 dark:border-gray-600">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 dark:border-gray-600">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 dark:border-gray-600">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 dark:border-gray-600">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-colors duration-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                        <i class="ph ph-pencil-simple text-sm"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition-colors duration-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-300 border border-red-200 dark:border-red-800">
                                            <i class="ph ph-trash text-sm"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        @if($users->isEmpty())
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="ph ph-users-three text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada user</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Mulai dengan menambahkan user pertama Anda</p>
                <a href="{{ route('admin.users.create') }}" 
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <i class="ph ph-user-plus"></i>
                    Tambah User
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* Utility Classes */
    .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
    
    .flex { display: flex; }
    .justify-between { justify-content: space-between; }
    .items-center { align-items: center; }
    .gap-2 { gap: 0.5rem; }
    .gap-3 { gap: 0.75rem; }
    
    .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
    .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
    .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
    .text-xs { font-size: 0.75rem; line-height: 1rem; }
    
    .font-bold { font-weight: 700; }
    .font-semibold { font-weight: 600; }
    .font-medium { font-weight: 500; }
    
    .text-gray-900 { color: #111827; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-500 { color: #6b7280; }
    .text-white { color: #ffffff; }
    
    .bg-white { background-color: #ffffff; }
    .bg-gray-50 { background-color: #f9fafb; }
    .bg-gray-100 { background-color: #f3f4f6; }
    .bg-green-50 { background-color: #ecfdf5; }
    .bg-red-50 { background-color: #fef2f2; }
    .bg-blue-50 { background-color: #eff6ff; }
    .bg-purple-100 { background-color: #f3e8ff; }
    .bg-blue-100 { background-color: #dbeafe; }
    
    .border { border-width: 1px; }
    .border-b { border-bottom-width: 1px; }
    .border-gray-200 { border-color: #e5e7eb; }
    .border-green-200 { border-color: #a7f3d0; }
    .border-red-200 { border-color: #fecaca; }
    .border-blue-200 { border-color: #bfdbfe; }
    
    .rounded-lg { border-radius: 0.5rem; }
    .rounded-xl { border-radius: 0.75rem; }
    .rounded-full { border-radius: 9999px; }
    
    .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    
    .px-4 { padding-left: 1rem; padding-right: 1rem; }
    .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
    .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
    .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
    .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
    
    .mt-2 { margin-top: 0.5rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-4 { margin-bottom: 1rem; }
    
    .w-full { width: 100%; }
    .w-8 { width: 2rem; }
    .h-8 { height: 2rem; }
    .w-24 { width: 6rem; }
    .h-24 { height: 6rem; }
    
    .overflow-x-auto { overflow-x: auto; }
    .overflow-hidden { overflow: hidden; }
    
    .whitespace-nowrap { white-space: nowrap; }
    
    .inline-flex { display: inline-flex; }
    
    .uppercase { text-transform: uppercase; }
    .tracking-wider { letter-spacing: 0.05em; }
    
    .transition-colors { transition-property: color, background-color, border-color, text-decoration-color, fill, stroke; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
    .transition-all { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
    .duration-200 { transition-duration: 200ms; }
    .duration-150 { transition-duration: 150ms; }
    
    .transform { transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); }
    .hover\:scale-105:hover { --tw-scale-x: 1.05; --tw-scale-y: 1.05; }
    
    .hover\:bg-gray-50:hover { background-color: #f9fafb; }
    .hover\:bg-blue-100:hover { background-color: #dbeafe; }
    .hover\:bg-red-100:hover { background-color: #fee2e2; }
    .hover\:bg-blue-700:hover { background-color: #1d4ed8; }
    
    /* Gradient Colors */
    .bg-gradient-to-r {
        background-image: linear-gradient(to right, var(--tw-gradient-stops));
    }
    
    .from-green-500 { --tw-gradient-from: #10b981; --tw-gradient-to: rgb(16 185 129 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
    .to-green-600 { --tw-gradient-to: #059669; }
    
    .from-blue-500 { --tw-gradient-from: #3b82f6; --tw-gradient-to: rgb(59 130 246 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
    .to-purple-600 { --tw-gradient-to: #9333ea; }
    
    .hover\:from-green-600:hover { --tw-gradient-from: #059669; --tw-gradient-to: rgb(5 150 105 / 0); }
    .hover\:to-green-700:hover { --tw-gradient-to: #047857; }
    
    /* Text Colors */
    .text-blue-700 { color: #1d4ed8; }
    .text-red-700 { color: #b91c1c; }
    .text-purple-800 { color: #6b21a8; }
    .text-blue-800 { color: #1e40af; }
    .text-green-700 { color: #15803d; }
    
    /* Dark Mode Styles */
    .dark .dark\:bg-gray-800 { background-color: #1f2937; }
    .dark .dark\:bg-gray-700 { background-color: #374151; }
    .dark .dark\:bg-gray-700\/50 { background-color: rgba(55, 65, 81, 0.5); }
    .dark .dark\:bg-green-900\/20 { background-color: rgba(6, 78, 59, 0.2); }
    .dark .dark\:bg-red-900\/20 { background-color: rgba(127, 29, 29, 0.2); }
    .dark .dark\:bg-blue-900\/30 { background-color: rgba(30, 58, 138, 0.3); }
    .dark .dark\:bg-purple-900\/30 { background-color: rgba(76, 29, 149, 0.3); }
    .dark .dark\:bg-red-900\/30 { background-color: rgba(153, 27, 27, 0.3); }
    
    .dark .dark\:text-white { color: #ffffff; }
    .dark .dark\:text-gray-300 { color: #d1d5db; }
    .dark .dark\:text-gray-400 { color: #9ca3af; }
    .dark .dark\:text-green-400 { color: #4ade80; }
    .dark .dark\:text-red-400 { color: #f87171; }
    .dark .dark\:text-blue-300 { color: #93c5fd; }
    .dark .dark\:text-red-300 { color: #fca5a5; }
    .dark .dark\:text-purple-300 { color: #d8b4fe; }
    
    .dark .dark\:border-gray-600 { border-color: #4b5563; }
    .dark .dark\:border-gray-700 { border-color: #374151; }
    .dark .dark\:border-green-800 { border-color: #065f46; }
    .dark .dark\:border-red-800 { border-color: #991b1b; }
    .dark .dark\:border-blue-800 { border-color: #1e40af; }
    
    .dark .dark\:hover\:bg-gray-700\/30:hover { background-color: rgba(55, 65, 81, 0.3); }
    .dark .dark\:hover\:bg-blue-900\/50:hover { background-color: rgba(30, 58, 138, 0.5); }
    .dark .dark\:hover\:bg-red-900\/50:hover { background-color: rgba(153, 27, 27, 0.5); }
    
    /* Divide Colors */
    .divide-y > * + * { border-top-width: 1px; }
    .divide-gray-200 > * + * { border-color: #e5e7eb; }
    .divide-gray-700 > * + * { border-color: #374151; }
    
    .dark .dark\:divide-gray-700 > * + * { border-color: #374151; }
</style>
@endsection