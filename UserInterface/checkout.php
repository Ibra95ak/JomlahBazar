<?php
include('../AdminPanel/libraries/base.php');
include("header.php");
?>
<div class="container">
  <div class="row mb-5">
    <div class="col-12 col-xl-8">
      <h5 class="font-weight-bold">Billing details</h5>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">First name</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Last name</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Company name (optional)</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Country</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Town / City </label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">State / County </label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Postcode / ZIP </label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Phone</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="email">Email address </label>
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="col-md-12">
          <div class="clearfix"></div>
          <hr>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
          <p>
            <input name="" type="checkbox" value=""> &nbsp; Ship to a different address?</p>
          <textarea  class="input-text form-control input-lg" id="order_comments" placeholder="Notes about your order, eg. special instructions for delivery." rows="3" cols="4"></textarea>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-4">
      <div class="cart_totals">
        <div class="table-responsive">
          <table cellspacing="0" class="table table-borderless mb-0">
            <tbody>
              <tr>
                <th>Product</th>
                <th class="text-right">Total</th>
              </tr>
              <tr class="product-boder">
                <td class="flat-rate"><strong>Dried Fruits</strong></td>
                <td class="text-right amount">39</td>
              </tr>
              <tr class="product-boder">
                <td><strong>Subtotal</strong></td>
                <td align="right">39</td>
              </tr>
              <tr>
                <td><strong>Shipping</strong> </td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr class="product-boder">
                <td><strong>Flat rate:</strong></td>
                <td align="right">20.00</td>
              </tr>
              <tr>
                <td><strong>Total:</strong></td>
                <td align="right">20.00</td>
              </tr>
            </tbody>
          </table>
          <div class="ul-css m-0">
            <ul class="m-0 ml-3">
              <li>
                <input  type="radio" checked="checked">
                <label for="payment_method_bacs"> Direct bank transfer </label>
                <div>
                  <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                </div>
              </li>
              <li>
                <input  type="radio" class="input-radio" value="cheque" data-order_button_text="">
                <label for="payment_method_cheque"> Check payments </label>
              </li>
              <li>
                <input  type="radio" class="input-radio" value="cheque" data-order_button_text="">
                <label for="payment_method_cheque">Cash on delivery</label>
              </li>
              <li>
                <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="" target="_blank">privacy policy</a>.</p>
              </li>
              <li> <a href="order-received.html" class="btn cart w-100"> Place order </a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php
include("footer.php"); ?>
