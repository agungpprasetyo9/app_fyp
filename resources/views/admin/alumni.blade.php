@extends('layouts.admindash')

@section('container')
<section class="container m-auto mt-11">
    
    <div class="relative overflow-x-auto rounded-xl">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        School
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telp
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnis as $row)
                <tr class="bg-white border-b dark:bg-gray-50 dark:border-gray-700">
                    
                        <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                            {{ $row->name }}
                        </th>
                        <td class="px-6 py-4 text-gray-600 ">
                            {{ $row->acceptance }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $row->school }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $row->universities}}
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
       
    </section>
@endsection"