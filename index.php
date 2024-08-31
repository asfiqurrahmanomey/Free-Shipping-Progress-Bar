// Progress Bar
function free_shipping_progress_bar_shortcode() {
    ob_start();
    ?>
    <div id="free-shipping-progress-container">
        <div id="free-shipping-progress-box">
            <div id="free-shipping-progress-title">Añade <strong>15,75€</strong> más para conseguir el envío gratis</div>
            <div id="free-shipping-progress-bar-background">
                <div id="free-shipping-progress-bar"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const freeShippingThreshold = 15.75; // Set your free shipping threshold
            const progressBar = document.getElementById('free-shipping-progress-bar');
            const progressText = document.getElementById('free-shipping-progress-title');
            
            const updateProgressBar = (cartTotal) => {
                const amountLeft = freeShippingThreshold - cartTotal;
                const percentage = (cartTotal / freeShippingThreshold) * 100;
                
                // Ensure the progress bar is always full, only show empty space if extra amount is needed
                progressBar.style.width = '100%';
                progressBar.style.background = linear-gradient(to right, #307650 ${Math.min(percentage, 100)}%, #C6D2C6 ${Math.min(percentage, 100)}%);

                if (amountLeft > 0) {
                    progressText.innerHTML = Añade <strong>€${amountLeft.toFixed(2)}</strong> más para conseguir el envío gratis;
                } else {
                    progressText.textContent = '¡Has conseguido el envío gratis!';
                }
            };

            const cartTotal = parseFloat(document.querySelector('.woocommerce-Price-amount').textContent.replace(/[^0-9.,]/g, '').replace(',', '.'));
            updateProgressBar(cartTotal);

            document.querySelectorAll('.quantity input, .woocommerce-cart .coupon input').forEach(input => {
                input.addEventListener('change', () => {
                    const updatedCartTotal = parseFloat(document.querySelector('.woocommerce-Price-amount').textContent.replace(/[^0-9.,]/g, '').replace(',', '.'));
                    updateProgressBar(updatedCartTotal);
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('free_shipping_progress_bar', 'free_shipping_progress_bar_shortcode');