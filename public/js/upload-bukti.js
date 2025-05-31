// Enhanced Payment Upload JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const paymentModal = document.getElementById('paymentModal');
    const paymentForm = document.getElementById('paymentForm');
    const fileInput = document.getElementById('bukti_bayar');
    const metodePembayaranSelect = document.querySelector('select[name="metode_pembayaran"]');

    // Show payment modal
    window.showPaymentModal = function() {
        paymentModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Reset form
        paymentForm.reset();
        document.querySelector('input[name="tanggal_bayar"]').value = new Date().toISOString().split('T')[0];

        // Reset file upload area
        resetFileUploadArea();

        // Add entrance animation
        paymentModal.style.opacity = '0';
        setTimeout(() => {
            paymentModal.style.opacity = '1';
            paymentModal.style.transition = 'opacity 0.3s ease-in-out';
        }, 10);
    };

    // Close payment modal
    window.closePaymentModal = function() {
        paymentModal.style.opacity = '0';
        setTimeout(() => {
            paymentModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    };

    // Reset file upload area
    function resetFileUploadArea() {
        const uploadArea = document.querySelector('.border-dashed');
        const previewContainer = document.getElementById('file-preview');

        uploadArea.classList.remove('border-green-400', 'bg-green-50', 'border-red-400', 'bg-red-50');
        uploadArea.classList.add('border-gray-300', 'bg-gray-50');

        if (previewContainer) {
            previewContainer.remove();
        }
    }

    // Enhanced file upload with preview
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate file
        const validation = validateFile(file);
        if (!validation.valid) {
            showToast(validation.message, 'error');
            this.value = '';
            resetFileUploadArea();
            return;
        }

        // Show file preview
        showFilePreview(file);
        showToast(`File berhasil dipilih: ${file.name}`, 'success');
    });

    // File validation
    function validateFile(file) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];

        if (file.size > maxSize) {
            return {
                valid: false,
                message: 'Ukuran file maksimal 5MB!'
            };
        }

        if (!allowedTypes.includes(file.type)) {
            return {
                valid: false,
                message: 'Format file harus JPG, PNG, atau PDF!'
            };
        }

        return { valid: true };
    }

    // Show file preview
    function showFilePreview(file) {
        const uploadArea = document.querySelector('.border-dashed');
        uploadArea.classList.remove('border-gray-300', 'bg-gray-50');
        uploadArea.classList.add('border-green-400', 'bg-green-50');

        // Remove existing preview
        const existingPreview = document.getElementById('file-preview');
        if (existingPreview) {
            existingPreview.remove();
        }

        // Create preview container
        const previewContainer = document.createElement('div');
        previewContainer.id = 'file-preview';
        previewContainer.className = 'mt-4 p-4 bg-green-50 border border-green-200 rounded-lg';

        const fileInfo = document.createElement('div');
        fileInfo.className = 'flex items-center justify-between';

        const fileDetails = document.createElement('div');
        fileDetails.className = 'flex items-center space-x-3';

        // File icon
        const fileIcon = document.createElement('div');
        fileIcon.className = 'w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center';

        if (file.type.startsWith('image/')) {
            fileIcon.innerHTML = `
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            `;

            // Add image preview for images
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgPreview = document.createElement('img');
                imgPreview.src = e.target.result;
                imgPreview.className = 'mt-3 max-w-32 h-auto rounded-lg border border-green-300';
                previewContainer.appendChild(imgPreview);
            };
            reader.readAsDataURL(file);
        } else {
            fileIcon.innerHTML = `
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            `;
        }

        // File info text
        const fileText = document.createElement('div');
        fileText.innerHTML = `
            <div class="font-medium text-green-800">${file.name}</div>
            <div class="text-sm text-green-600">${formatFileSize(file.size)} • ${file.type}</div>
        `;

        // Remove button
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'text-green-600 hover:text-green-800 p-1 rounded-lg hover:bg-green-200';
        removeBtn.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        `;
        removeBtn.onclick = function() {
            fileInput.value = '';
            resetFileUploadArea();
        };

        fileDetails.appendChild(fileIcon);
        fileDetails.appendChild(fileText);
        fileInfo.appendChild(fileDetails);
        fileInfo.appendChild(removeBtn);
        previewContainer.appendChild(fileInfo);

        // Insert preview after upload area
        uploadArea.parentNode.insertBefore(previewContainer, uploadArea.nextSibling);
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Handle payment method change
    metodePembayaranSelect.addEventListener('change', function() {
        const method = this.value;
        showPaymentInstructions(method);
    });

    // Show payment instructions based on method
    function showPaymentInstructions(method) {
        // Remove existing instructions
        const existingInstructions = document.getElementById('payment-instructions');
        if (existingInstructions) {
            existingInstructions.remove();
        }

        if (!method) return;

        const instructionsContainer = document.createElement('div');
        instructionsContainer.id = 'payment-instructions';
        instructionsContainer.className = 'mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg';

        let instructions = '';
        switch (method) {
            case 'transfer':
                instructions = `
                    <div class="font-semibold text-blue-900 mb-3">Instruksi Transfer Bank</div>
                    <div class="space-y-2 text-sm text-blue-800">
                        <div>1. Transfer ke salah satu rekening berikut:</div>
                        <div class="ml-4">
                            <div>• BCA: 1234567890 a.n. INKAI Kediri</div>
                            <div>• Mandiri: 0987654321 a.n. INKAI Kediri</div>
                        </div>
                        <div>2. Jumlah transfer: <strong>${document.querySelector('.text-2xl.font-bold.text-blue-600').textContent}</strong></div>
                        <div>3. Simpan bukti transfer</div>
                        <div>4. Upload bukti transfer di form ini</div>
                    </div>
                `;
                break;
            case 'qris':
                instructions = `
                    <div class="font-semibold text-blue-900 mb-3">Instruksi Pembayaran QRIS</div>
                    <div class="space-y-2 text-sm text-blue-800">
                        <div>1. Buka aplikasi mobile banking atau e-wallet</div>
                        <div>2. Pilih menu Scan QR atau QRIS</div>
                        <div>3. Scan QR Code yang disediakan panitia</div>
                        <div>4. Masukkan nominal: <strong>${document.querySelector('.text-2xl.font-bold.text-blue-600').textContent}</strong></div>
                        <div>5. Selesaikan pembayaran</div>
                        <div>6. Screenshot bukti pembayaran dan upload di form ini</div>
                    </div>
                `;
                break;
            case 'cash':
                instructions = `
                    <div class="font-semibold text-blue-900 mb-3">Instruksi Pembayaran Tunai</div>
                    <div class="space-y-2 text-sm text-blue-800">
                        <div>1. Datang ke sekretariat INKAI Kediri</div>
                        <div>2. Alamat: Jl. Brawijaya No. 123, Kediri</div>
                        <div>3. Jam operasional: Senin-Jumat 08:00-16:00</div>
                        <div>4. Bayar sejumlah: <strong>${document.querySelector('.text-2xl.font-bold.text-blue-600').textContent}</strong></div>
                        <div>5. Minta bukti pembayaran/kwitansi</div>
                        <div>6. Foto kwitansi dan upload di form ini</div>
                    </div>
                `;
                break;
        }

        instructionsContainer.innerHTML = instructions;
        metodePembayaranSelect.parentNode.appendChild(instructionsContainer);
    }

    // Enhanced form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate form
        if (!validatePaymentForm()) {
            return;
        }

        // Show confirmation
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi Upload',
                html: getConfirmationContent(),
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Upload!',
                cancelButtonText: 'Periksa Lagi',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg',
                    cancelButton: 'rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitPaymentForm();
                }
            });
        } else {
            if (confirm('Apakah Anda yakin data pembayaran sudah benar?')) {
                submitPaymentForm();
            }
        }
    });

    // Validate payment form
    function validatePaymentForm() {
        const requiredFields = [
            { name: 'metode_pembayaran', message: 'Pilih metode pembayaran' },
            { name: 'tanggal_bayar', message: 'Pilih tanggal pembayaran' },
            { name: 'bukti_bayar', message: 'Upload bukti pembayaran' }
        ];

        for (let field of requiredFields) {
            const input = paymentForm.querySelector(`[name="${field.name}"]`);
            if (!input.value) {
                showToast(field.message, 'error');
                input.focus();
                return false;
            }
        }

        // Validate date
        const tanggalBayar = new Date(paymentForm.querySelector('[name="tanggal_bayar"]').value);
        const today = new Date();
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(today.getDate() - 30);

        if (tanggalBayar > today) {
            showToast('Tanggal pembayaran tidak boleh di masa depan', 'error');
            return false;
        }

        if (tanggalBayar < thirtyDaysAgo) {
            showToast('Tanggal pembayaran tidak boleh lebih dari 30 hari yang lalu', 'error');
            return false;
        }

        return true;
    }

    // Get confirmation content
    function getConfirmationContent() {
        const metode = paymentForm.querySelector('[name="metode_pembayaran"]').selectedOptions[0].text;
        const tanggal = paymentForm.querySelector('[name="tanggal_bayar"]').value;
        const file = fileInput.files[0];
        const keterangan = paymentForm.querySelector('[name="keterangan"]').value;

        return `
            <div class="text-left space-y-2">
                <div><strong>Metode:</strong> ${metode}</div>
                <div><strong>Tanggal:</strong> ${new Date(tanggal).toLocaleDateString('id-ID')}</div>
                <div><strong>File:</strong> ${file.name} (${formatFileSize(file.size)})</div>
                ${keterangan ? `<div><strong>Keterangan:</strong> ${keterangan}</div>` : ''}
            </div>
        `;
    }

    // Submit payment form
    function submitPaymentForm() {
        const submitBtn = paymentForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <div class="flex items-center justify-center space-x-2">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                <span>Mengupload...</span>
            </div>
        `;

        // Create FormData for file upload
        const formData = new FormData(paymentForm);

        // Submit via fetch for better error handling
        fetch(paymentForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json().catch(() => {
                // If not JSON, it might be a redirect - reload the page
                window.location.reload();
            });
        })
        .then(data => {
            if (data && data.success) {
                showToast(data.message || 'Bukti pembayaran berhasil diupload!', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            showToast('Gagal mengupload bukti pembayaran. Silakan coba lagi.', 'error');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }

    // Drag and drop functionality
    const dropArea = document.querySelector('.border-dashed');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropArea.classList.add('border-blue-400', 'bg-blue-50');
    }

    function unhighlight(e) {
        dropArea.classList.remove('border-blue-400', 'bg-blue-50');
    }

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
        }
    }

    // Close modal when clicking outside
    paymentModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !paymentModal.classList.contains('hidden')) {
            closePaymentModal();
        }
    });
});

// Enhanced toast notification function
window.showToast = function(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();

    const toast = document.createElement('div');
    toast.className = `toast-item ${type} transform translate-x-full transition-transform duration-300`;

    const icons = {
        success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>`,
        error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
               </svg>`,
        info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>`
    };

    toast.innerHTML = `
        <div class="flex items-center space-x-3 p-4 rounded-xl shadow-lg border backdrop-blur-sm
                    ${type === 'success' ? 'bg-green-50 text-green-800 border-green-200' :
                      type === 'error' ? 'bg-red-50 text-red-800 border-red-200' :
                      'bg-blue-50 text-blue-800 border-blue-200'}">
            <div class="flex-shrink-0">
                ${icons[type]}
            </div>
            <div class="flex-1 font-medium">${message}</div>
            <button onclick="this.closest('.toast-item').remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 p-1 rounded-lg hover:bg-white hover:bg-opacity-20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `;

    toastContainer.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    // Auto remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
};

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-4 right-4 z-50 space-y-2';
    document.body.appendChild(container);
    return container;
}
