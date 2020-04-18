<?php include('header.php');?>
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                3 Columns Form Layout
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Full Name:</label>
                    <input type="email" class="form-control" placeholder="Enter full name">
                    <span class="form-text text-muted">Please enter your full name</span>
                </div>
                <div class="col-lg-4">
                    <label class="">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email">
                    <span class="form-text text-muted">Please enter your email</span>
                </div>
                <div class="col-lg-4">
                    <label>Username:</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="la la-user"></i></span></div>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    <span class="form-text text-muted">Please enter your username</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="">Contact:</label>
                    <input type="email" class="form-control" placeholder="Enter contact number">
                    <span class="form-text text-muted">Please enter your contact</span>
                </div>
                <div class="col-lg-4">
                    <label class="">Fax:</label>
                    <div class="kt-input-icon kt-input-icon--right">
                        <input type="text" class="form-control" placeholder="Fax number">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                    class="la la-info-circle"></i></span></span>
                    </div>
                    <span class="form-text text-muted">Please enter fax</span>
                </div>
                <div class="col-lg-4">
                    <label>Address:</label>
                    <div class="kt-input-icon kt-input-icon--right">
                        <input type="text" class="form-control" placeholder="Enter your address">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                    class="la la-map-marker"></i></span></span>
                    </div>
                    <span class="form-text text-muted">Please enter your address</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="">Postcode:</label>
                    <div class="kt-input-icon kt-input-icon--right">
                        <input type="text" class="form-control" placeholder="Enter your postcode">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                    class="la la-bookmark-o"></i></span></span>
                    </div>
                    <span class="form-text text-muted">Please enter your postcode</span>
                </div>
                <div class="col-lg-4">
                    <label class="">User Group:</label>
                    <div class="kt-radio-inline">
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="example_2" checked value="2"> Sales Person
                            <span></span>
                        </label>
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="example_2" value="2"> Customer
                            <span></span>
                        </label>
                    </div>
                    <span class="form-text text-muted">Please select user group</span>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        <button type="reset" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->

<?php include("footer.php");?>