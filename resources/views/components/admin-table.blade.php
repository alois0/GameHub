<div class="table-responsive mb-8" style="max-height: 80vh;">
    <table id="usersTable" class="min-w-full bg-white table-fixed datatable">   
        <thead>
            <tr>
                @foreach($headers as $header)
                <th class="py-2 px-4 border-b text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#{{ $id }}').DataTable({
            pageLength: 25,
            searching: true,
            ordering: true,        
        });
    });
</script>