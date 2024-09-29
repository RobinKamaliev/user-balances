<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <p>Баланс: <span id="balance">{{ $balance ?? 0 }}</span></p>

                        <h3>Последние 5 операций</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody id="operations">
                            @foreach ($operations ?? [] as $operation)
                                <tr>
                                    <td>{{ $operation->amount }}</td>
                                    <td>{{ $operation->description }}</td>
                                    <td>{{ $operation->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

