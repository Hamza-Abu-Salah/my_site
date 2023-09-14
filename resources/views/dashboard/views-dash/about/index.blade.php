@extends('dashboard.layouts.master')
@section('css')

    @section('title')
        المستخدمين
    @stop

    <!-- Internal Data table css -->

    <link href="{{ URL::asset('assets/dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/dashboard/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/dashboard/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/dashboard/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/dashboard/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Dashboard</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    About Me</span>
            </div>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="main-body">
        <div id="error_message"></div>
        <div class="modal" id="modalAboutMeAdd">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">About Me</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <ul id="list_error_message"></ul>
                        <form id="formAboutAdd" enctype="multipart/form-data">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Name :</label>
                                    <input type="text" class="form-control" name="name_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Birthday :</label>
                                    <input type="date" class="form-control" name="Birthday" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Mail :</label>
                                    <input type="email" class="form-control" name="Mail" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Phone :</label>
                                    <input type="text" class="form-control" name="Phone" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Address :</label>
                                    <input type="text" class="form-control" name="Address_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Nationality :</label>
                                    <input type="text" class="form-control" name="Nationality_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Job Title :</label>
                                    <input type="text" class="form-control" name="job_title_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Cv :</label>
                                    <input type="file" class="form-control" name="cv" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">First Photo :</label>
                                    <input type="file" class="form-control" name="first_photo" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Second Photo :</label>
                                    <input type="file" class="form-control" name="second_photo" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Job Description :</label>
                                    <textarea class="form-control"  rows="3" name="job_description_en" required> </textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">About Me :</label>
                                    <textarea class="form-control" name="about_en" rows="3" required> </textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="form-label">Status :</label>
                                    <select name="status" class="form-control">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="NACTIVE">NACTIVE</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"
                                        id="addAbout">Save</button>
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
        <div class="modal" id="modalAboutMeUpdate">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Update About Me</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <ul id="list_error_message2"></ul>
                        <form id="formAboutUpdate" enctype="multipart/form-data">
                            @method('PUT')
                            <input type="hidden" class="form-control" name="id" id="id">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Name :</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Birthday :</label>
                                    <input type="date" class="form-control" id="Birthday" name="Birthday" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Mail :</label>
                                    <input type="email" class="form-control" id="Mail" name="Mail" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Phone :</label>
                                    <input type="text" class="form-control" id="Phone" name="Phone" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Address :</label>
                                    <input type="text" class="form-control" id="Address_en" name="Address_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Nationality :</label>
                                    <input type="text" class="form-control" id="Nationality_en" name="Nationality_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Job Title :</label>
                                    <input type="text" class="form-control" id="job_title_en" name="job_title_en" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Cv :</label>
                                    <input type="file" class="form-control" id="cv" name="cv" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">First Photo :</label>
                                    <input type="file" class="form-control" id="first_photo" name="first_photo" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Second Photo :</label>
                                    <input type="file" class="form-control" id="second_photo" name="second_photo" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Job Description :</label>
                                    <textarea class="form-control"  rows="3" id="job_description_en" name="job_description_en" required> </textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">About Me :</label>
                                    <textarea class="form-control" id="about_en" name="about_en" rows="3" required> </textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="form-label">Status :</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="NACTIVE">NACTIVE</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"
                                        id="updateAbout">Update</button>
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->

        <div class="modal" id="modalAboutMeDelete" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Operation</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <ul id="list_error_message3"></ul>
                    <div class="modal-body">
                        <p>Are sure of the deleting process?</p><br>
                        <input class="form-control" id="nameDetele" type="text" readonly="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="deleteAbout">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                            <div class="row row-xs wd-xl-80p">
                                <div class="col-sm-6 col-md-3 mg-t-10">
                                    <button class="btn btn-info-gradient btn-block" id="ShowModalAboutMe"
                                    style="font-weight: bold; color: beige;">Addition
                                    </button>
                                </div>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive hoverable-table">
                                <table class="table table-hover" id="get_about" style=" text-align: center;">
                                    <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">First Photo</th>
                                        <th class="border-bottom-0">Name</th>
                                        <th class="border-bottom-0">Mail</th>
                                        <th class="border-bottom-0">Phone</th>
                                        <th class="border-bottom-0">Job Title</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Processes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dashboard/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/dashboard/js/select2.js')}}"></script>
    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/dashboard/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/dashboard/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/dashboard/local/about.js')}}"></script>
@endsection
