@include('frontend.dashboard.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >


@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<section class="section pt-4 pb-4 osahan-account-page">
         <div class="container">
            <div class="row">

            @include('frontend.dashboard.sidebar')

               <div class="col-md-9">
                  <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                           <h4 class="font-weight-bold mt-0 mb-4">User Profile</h4>


                           <div class="bg-white card mb-4 order-list shadow-sm">
                              <div class="gold-members p-4">

                              <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Name</label>
                                        <input class="form-control" name="name" type="text" value="{{ $profileData->name }}" id="example-text-input">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Email</label>
                                        <input class="form-control" name="email" type="email" value="{{ $profileData->email }}" id="example-text-input">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Phone</label>
                                        <input class="form-control" name="phone" type="text" value="{{ $profileData->phone }}" id="example-text-input">
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Address</label>
                                        <input class="form-control" name="address" type="text" value="{{ $profileData->address }}" id="example-text-input">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Profile Image</label>
                                        <input class="form-control" name="foto" type="file"id="image">
                                    </div>

                                    <div class="mb-3">
                                        <div class="avatar-xl me-3" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                            <img id="showImage" src="{{ (!empty($profileData->foto)) ? url('upload/user_images/'.$profileData->foto) : url('upload/profileXample.jpg') }}" alt="" class="rounded-circle p-1 bg-primary" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                                 
                              </div>
                           </div>


                        </div>
                        <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab">
                           <h4 class="font-weight-bold mt-0 mb-4">Offers</h4>
                           <div class="row mb-4 pb-2">
                              <div class="col-md-6">
                                 <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                       <h5 class="card-title"><img src="img/bank/1.png"> OSAHANEAT50</h5>
                                       <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                                       <p class="card-text">Use code OSAHANEAT50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                                       <a href="#" class="card-link">COPY CODE</a>
                                       <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                       <h5 class="card-title"><img src="img/bank/2.png"> EAT730</h5>
                                       <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first osahan eat order</h6>
                                       <p class="card-text">Use code EAT730 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                                       <a href="#" class="card-link">COPY CODE</a>
                                       <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>  
                        <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">
                           <h4 class="font-weight-bold mt-0 mb-4">Favourites</h4>
                           <div class="row">
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/4.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">Famous Dave's Bar-B-Que
                                             </a>
                                          </h6>
                                          <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–30 min</span> <span class="float-right text-black-50"> $350 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-danger">OFFER</span> <small> Use Coupon OSAHAN50</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/5.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">Thai Famous Cuisine</a></h6>
                                          <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-success">OFFER</span> <small>65% off</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/6.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">The osahan Restaurant
                                             </a>
                                          </h6>
                                          <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/7.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">Stan's Restaurant
                                             </a>
                                          </h6>
                                          <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-danger">OFFER</span> <small>65% Coupon OSAHAN50</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/8.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">Polo Lounge
                                             </a>
                                          </h6>
                                          <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-danger">OFFER</span> <small> Coupon OSAHAN50</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                 <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                       <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                       <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                       <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                       <a href="detail.html">
                                       <img src="img/list/9.png" class="img-fluid item-img">
                                       </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                       <div class="list-card-body">
                                          <h6 class="mb-1"><a href="detail.html" class="text-black">Jack Fry's
                                             </a>
                                          </h6>
                                          <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                       </div>
                                       <div class="list-card-badge">
                                          <span class="badge badge-danger">OFFER</span> <small>65% </small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 text-center load-more">
                                 <button class="btn btn-primary" type="button" disabled>
                                 <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                 Loading...
                                 </button>   
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                           <h4 class="font-weight-bold mt-0 mb-4">Payments</h4>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                       <a href="#">
                                          <div class="media">
                                             <img class="mr-3" src="img/bank/1.png" alt="Generic placeholder image">
                                             <div class="media-body">
                                                <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                <p>VALID TILL 10/2025</p>
                                                <p class="mb-0 text-black font-weight-bold">
                                       <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                       </div>
                                       </div>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                       <a href="#">
                                          <div class="media">
                                             <img class="mr-3" src="img/bank/2.png" alt="Generic placeholder image">
                                             <div class="media-body">
                                                <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                <p>VALID TILL 10/2025</p>
                                                <p class="mb-0 text-black font-weight-bold">
                                       <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                       </div>
                                       </div>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                        <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                           <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                    <div class="gold-members p-4">
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1 text-secondary">Home</h6>
                                             <p class="text-black">Osahan House, Jawaddi Kalan, Ludhiana, Punjab 141002, India
                                             </p>
                                             <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal"  href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="bg-white card addresses-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Work</h6>
                                             <p>NCC, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                             </p>
                                             <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>



            </div>
         </div>
      </section>

      <script type="text/javascript">
         $(document).ready(function(){
            $('#image').change(function(e){
               var reader = new FileReader();
               reader.onload = function(e){
                  $('#showImage').attr('src',e.target.result);
               }
               reader.readAsDataURL(e.target.files['0']);
            })
         })
      </script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>


      @include('frontend.dashboard.footer')
