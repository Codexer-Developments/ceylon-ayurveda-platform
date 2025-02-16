<table class="w-full border-collapse border border-gray-300">
    <thead>
    <tr class="bg-gray-200">
        <th class="border border-gray-300 px-4 py-2">GRN Number</th>
        <th class="border border-gray-300 px-4 py-2">Received Date</th>
        <th class="border border-gray-300 px-4 py-2">Total Amount</th>
        <th class="border border-gray-300 px-4 py-2">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($goodsReceivedNotes as $grn)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $grn->grn_number }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $grn->received_date }}</td>
            <td class="border border-gray-300 px-4 py-2">LKR {{ number_format($grn->total_amount, 2) }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $grn->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
