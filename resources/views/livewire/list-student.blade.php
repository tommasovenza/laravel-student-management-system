<div class="bg-gray-100 py-10">
    <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Students
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the Students.
                    </p>
                </div>
  
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('students.create') }}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                        Add Student
                    </a>
                </div>
            </div>
  
            <div class="flex flex-col justify-between sm:flex-row mt-6">
                <div class="relative text-sm text-gray-800 col-span-3">
                    <div
                        class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                        <x-magnifying-glass />
                    </div>
                    
                    {{-- set wire model here --}}
                    <input 
                        wire:model.live="search" 
                        type="text" 
                        placeholder="Search students data..." 
                        id="search"
                        class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                    />
                </div>

                {{-- Hidden Area --}}
                <div class="controls-area" x-data="{ open: false }">
                    <div class="flex justify-items items-center gap-2" x-show="$wire.selectedStudentIds.length > 0"> 
                        {{-- Selected Items --}}
                        <div>
                            <span x-text="$wire.selectedStudentIds.length"></span> Selected
                        </div>

                        {{-- Delete Button --}}
                        <div class="container-button  bg-gray-100 border rounded p-2">
                            <button class="flex justify-items items-center gap-2">Delete
                            {{-- Icon Delete --}}
                            <svg 
                                class="w-4 h-4 text-gray-400  00 dark:text-white" 
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                            </svg>
                            </button> 
                        </div>
                    
                        <div class="container-button bg-gray-100 border rounded p-2">
                            {{-- Export Button --}}
                            <button class="flex justify-items items-center gap-2">Export
                                <svg 
                                    class="w-4 h-4 text-gray-400 dark:text-white" 
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
  
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Action
                                        </th>

                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            <button wire:click="sortBy('id')">ID</button>
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Class
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Section
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            <button wire:click="sortBy('created_at')">Created At</button>
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <span x-text="$wire.selectedStudentIds"></span> 
                                  @foreach ($students as $student)
                                    <tr>
                                        <td class="flex justify-center items-center whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{-- Checkbox --}}
                                            <input 
                                                type=checkbox 
                                                id="select-student-id" 
                                                class="rounded" 
                                                wire:model.live="selectedStudentIds" 
                                                value="{{ $student->id }}"
                                            >
                                        </td>

                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $student->id }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $student->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                          {{ $student->email }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                          {{ $student->class->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                          {{ $student->section->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            2 days ago
                                        </td>
  
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">

                                            {{-- Edit --}}
                                            <a href="{{ route('student.edit' , $student->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
                                            
                                            <button wire:confirm="Are you sure you want delete this Student?" wire:click="deleteStudent({{ $student->id }})" class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>

                            <div wire:loading class="absolute inset-0 bg-white opacity-50">
                                {{-- layer with background white --}}
                            </div>

                            <div wire:loading.flex class="flex justify-center items-center absolute inset-0">
                                <x-icons.spinner class="h-12 w-12 text-indigo-600" /> 
                            </div>

                        </div>
                        {{-- Pagination --}}
                        <div class="mt-5">
                          {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    