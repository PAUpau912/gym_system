function showPaymentFields() {
    const method = document.getElementById('PaymentMethod').value;
    let fields = '';

    switch (method) {
        case 'Card':
            fields = `
            <div class="form-control-custom">       <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" class="form-control" maxlength="16" name="CardNumber" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="CardExpiry" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>CVV</label>
                            <input type="text" class="form-control" maxlength="4" name="CardCVV" required>
                        </div>
                    </div></div>
             
                `;
            break;
        case 'Cash':
            fields = `
            <div class="form-control-custom">  
                    <div class="form-group">
                        <label>Cash Reference</label>
                        <input type="text" class="form-control" maxlength="10" name="CashReference" required>
                    </div>
                    </div>
                `;
            break;
        case 'Gcash':
            fields = `
            <div class="form-control-custom">  
                    <div class="form-group">
                        <label>Gcash Number</label>
                        <input type="text" class="form-control" maxlength="11" name="GcashNumber" required>
                    </div></div>
                `;
            break;
        case 'Maya':
            fields = `
            <div class="form-control-custom">  
                    <div class="form-group">
                        <label>Maya Number</label>
                        <input type="text" class="form-control" maxlength="11" name="MayaNumber" required>
                    </div>
                    </div>
                `;
            break;
        default:
            fields = '';
    }

    document.getElementById('paymentFields').innerHTML = fields;

    // Ensure only numeric input
    const inputs = document.querySelectorAll('#paymentFields input[type="text"]');
    inputs.forEach(input => {
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    });
}