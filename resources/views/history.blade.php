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
                        <form method="GET" action="{{ route('dashboard-history') }}">
                            <div class="mb-3">
                                <input type="text" name="description" class="form-control dark:text-amber-950"
                                       placeholder="Поиск по описанию." value="">
                                <button type="submit" class="btn btn-primary mt-2">Поиск</button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
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
