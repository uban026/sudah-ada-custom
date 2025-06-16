<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Baju Kustom - {{ config('app.name') }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Style untuk tombol file agar konsisten */
        input[type="file"]::file-selector-button {
            background-color: #1f2937;
            /* bg-gray-800 */
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #374151;
            /* hover:bg-gray-700 */
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-6xl mx-auto">

        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Desain & Beli Kaos Kustom Anda</h1>
            <p class="text-gray-600 mt-2">Unggah desain Anda sendiri untuk membuat kaos yang unik.</p>
        </header>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            <div class="w-full lg:w-1/2 flex justify-center">
                <div id="tshirt-div"
                    class="relative w-[452px] h-[548px] max-w-full bg-white rounded-2xl shadow-lg transition-colors duration-300">
                    <img id="tshirt-backgroundpicture"
                        src="https://ourcodeworld.com/public-media/gallery/gallery-5d5afd3f1c7d6.png"
                        alt="Gambar dasar T-shirt" class="w-full h-full rounded-2xl" />
                    <div id="drawingArea" class="absolute top-[60px] left-[122px] z-10 w-[200px] h-[400px]">
                        <div class="relative w-[200px] h-[400px] select-none">
                            <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 bg-white p-6 sm:p-8 rounded-2xl shadow-lg">
                <div class="space-y-6">
                    <div>
                        <label for="tshirt-color" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Warna
                            Kaos:</label>
                        <select id="tshirt-color"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="#ffffff" data-price="0">Putih</option>
                            <option value="#000000" data-price="5000">Hitam (+Rp 5.000)</option>
                        </select>
                    </div>

                    <div>
                        <label for="tshirt-custompicture" class="block text-sm font-semibold text-gray-700 mb-2">Unggah
                            Desain Anda:</label>
                        <input type="file" id="tshirt-custompicture" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700 cursor-pointer" />
                    </div>

                    <hr class="border-gray-200">

                    <div>
                        <label for="tshirt-size" class="block text-sm font-semibold text-gray-700 mb-2">Ukuran:</label>
                        <select id="tshirt-size"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="S" data-price="0">S</option>
                            <option value="M" data-price="0">M</option>
                            <option value="L" data-price="0">L</option>
                            <option value="XL" data-price="10000">XL (+Rp 10.000)</option>
                            <option value="XXL" data-price="15000">XXL (+Rp 15.000)</option>
                        </select>
                    </div>

                    <div>
                        <label for="tshirt-quantity"
                            class="block text-sm font-semibold text-gray-700 mb-2">Jumlah:</label>
                        <input type="number" id="tshirt-quantity" value="1" min="1"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <hr class="border-gray-200">

                    <div class="space-y-3">
                        <h3 class="text-lg font-semibold text-gray-800">Rincian Harga</h3>
                        <div class="flex justify-between items-center text-gray-700">
                            <span>Harga Dasar:</span>
                            <span id="base-price">Rp 85.000</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-700">
                            <span>Biaya Tambahan:</span>
                            <span id="extra-cost">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center text-xl font-bold text-gray-900 mt-2">
                            <span>Total:</span>
                            <span id="total-price">Rp 85.000</span>
                        </div>
                    </div>

                    <button id="buy-button"
                        class="w-full bg-yellow-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-yellow-500 transition-transform transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-md">
                        Beli Sekarang
                    </button>
                </div>
            </div>
        </div>

        <p class="text-center text-gray-500 mt-8 text-sm">
            Pilih gambar pada kaos lalu tekan tombol <kbd
                class="bg-gray-800 text-white text-xs py-1 px-2 rounded-md font-mono">DEL</kbd> atau <kbd
                class="bg-gray-800 text-white text-xs py-1 px-2 rounded-md font-mono">Backspace</kbd> untuk
            menghapusnya.
        </p>
    </div>

    <script>
        // Menggunakan skrip asli yang seharusnya bekerja dalam lingkungan yang terisolasi
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = new fabric.Canvas('tshirt-canvas');
            const basePrice = 85000;

            const formatRupiah = (number) => new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);

            function updatePrice() {
                const colorPrice = parseInt(document.getElementById("tshirt-color").selectedOptions[0].dataset
                    .price || 0, 10);
                const sizePrice = parseInt(document.getElementById("tshirt-size").selectedOptions[0].dataset
                    .price || 0, 10);
                const quantity = parseInt(document.getElementById('tshirt-quantity').value, 10) || 1;
                const totalExtraCost = colorPrice + sizePrice;
                const totalPrice = (basePrice + totalExtraCost) * quantity;
                document.getElementById('extra-cost').textContent = formatRupiah(totalExtraCost * quantity);
                document.getElementById('total-price').textContent = formatRupiah(totalPrice);
            }

            document.getElementById("tshirt-color").addEventListener("change", function() {
                document.getElementById("tshirt-div").style.backgroundColor = this.value;
                updatePrice();
            });

            ["tshirt-size", "tshirt-quantity", "tshirt-quantity"].forEach(id => document.getElementById(id)
                .addEventListener("input", updatePrice));

            document.getElementById('tshirt-custompicture').addEventListener("change", function(e) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgObj = new Image();
                    imgObj.src = event.target.result;
                    canvas.getObjects().forEach(obj => {
                        if (obj.isType('image')) canvas.remove(obj);
                    });
                    imgObj.onload = function() {
                        const image = new fabric.Image(imgObj);
                        image.scaleToHeight(200);
                        image.scaleToWidth(180);
                        canvas.centerObject(image);
                        canvas.add(image);
                        canvas.renderAll();
                    };
                };
                if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
            });

            document.addEventListener("keydown", function(e) {
                if (e.key === 'Delete' || e.key === 'Backspace') {
                    const activeObject = canvas.getActiveObject();
                    if (activeObject) canvas.remove(activeObject);
                }
            });
            canvas.on('object:moving', (options) => {
                const obj = options.target;
                obj.setCoords();
                const bounds = obj.getBoundingRect();
                if (bounds.left < 0) obj.left = 0;
                if (bounds.top < 0) obj.top = 0;
                if (bounds.left + bounds.width > canvas.width) obj.left = canvas.width - bounds.width;
                if (bounds.top + bounds.height > canvas.height) obj.top = canvas.height - bounds.height;
            });
            document.getElementById('buy-button').addEventListener('click', () => {
                if (canvas.getObjects().filter(o => o.type === 'image').length === 0) {
                    alert("Harap unggah desain Anda terlebih dahulu.");
                    return;
                }
                const color = document.getElementById('tshirt-color').selectedOptions[0].text;
                const size = document.getElementById('tshirt-size').value;
                const quantity = document.getElementById('tshirt-quantity').value;
                const totalPrice = document.getElementById('total-price').textContent;
                const alertMessage =
                    `\n--- Detail Pesanan Kustom ---\n\nWarna Kaos: ${color}\nUkuran: ${size}\nJumlah: ${quantity}\nTotal Harga: ${totalPrice}\n\n---------------------------------\nData ini siap untuk diproses lebih lanjut.\n            `;
                alert(alertMessage);
            });
            updatePrice();
        });
    </script>
</body>

</html>
