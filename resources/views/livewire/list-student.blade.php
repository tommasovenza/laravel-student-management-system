<div class="flex items-center justify-center min-h-screen bg-gray-100">
  <div>
    {{--  --}}
    <div class="container-button flex justify-end items-center w-full py-4">
      <a href="{{ route('student.create') }}" as="button" class="bg-indigo-500 hover:bg-indigo-700 text-white py-2 px-4 rounded">Create</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-gray-200 w-full flex items-center justify-center px-4">
      <table class="min-w-full text-sm text-gray-800">
        <thead class="text-black">
          <tr>
            <th scope="col" class="py-3.5 pl-6 pr-3 text-left font-semibold">ID</th>
            <th scope="col" class="px-3 py-3.5 text-left font-semibold">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left font-semibold">Email</th>
            <th scope="col" class="px-3 py-3.5 text-left font-semibold">Class</th>
            <th scope="col" class="px-3 py-3.5 text-left font-semibold">Section</th>
            <th scope="col" class="px-3 py-3.5 text-right font-semibold">Created At</th>
            <th scope="col" class="py-3.5 pl-3 pr-6 text-right font-semibold">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white ">
          @foreach ($students as $student)
            <tr class="hover:bg-gray-50">
                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                {{ $student->id }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                {{ $student->name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                {{ $student->email }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                {{ $student->class->name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                {{ $student->section->name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-right text-gray-700">
                2 days ago
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                <button class="ml-3 text-rose-600 hover:text-rose-700">Delete</button>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <div class="mt-4">
      {{ $students->links() }}
    </div>
  </div>
</div>

