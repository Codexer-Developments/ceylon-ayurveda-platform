

<x-filament-panels::page>

    <div class="print-container">
        <div class="row">

            <div class="col-md-6">


            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                <!-- Example Widget 1 -->
                <div class="bg-white shadow rounded-lg p-2">

                    <ul class="divide-y divide-gray-200">
                        <li class="py-4">
                            <div class="flex justify-between">
                                <span><b>Product Name:</b> {{ $this->productDetails->name }}</span>
                            </div>
                        </li>
                        <li class="py-4">
                            <div class="flex justify-between">
                                <span><b>Product Price:</b> {{ $this->productManagement->price }}</span>
                            </div>
                        </li>
                        <li class="py-4">
                            <div class="flex justify-between">
                                <span><b>Product Quantity:</b> {{ $this->productManagement->quantity }}</span>
                            </div>
                        </li>
                        <li class="py-4">
                            <div class="flex justify-between">
                                <span><b>Product Description:</b> {{ $this->productDetails->description }}</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Example Widget 2 -->
                <div class="bg-white shadow rounded-lg p-2">
                    <form action="{{route('product.barcode')}}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="barcode_quantity" class="block text-sm font-medium text-gray-700">
                                Barcode Quantity
                            </label>
                            <input type="hidden" name="product_id" value="{{$this->productDetails->id}}">
                            <input type="number" VALUE="30" name="barcode_quantity" id="barcode_quantity"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Enter quantity" required>
                        </div>
                        <button type="submit" style="background: grey" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Generate Barcodes
                        </button>
                    </form>



                </div>

            </div>
        </div>
    </div>

    <!-- Print Button -->
</x-filament-panels::page>
