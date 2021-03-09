@extends('layouts.app');

@section('main-content')
			<!-- Page Wrapper -->
            <div class="page-wrapper">

                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome  {{  Auth::user() -> name  }}!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
                    <!-- /Page Header -->

               <div class="row">
                     <div class="col-md-10">
                            @include('validate')
							<a class="btn btn-success" data-toggle="modal" href="#category_modal">Add new Category</a>
							<br>
							<br>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Categorys</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0 post-table">
											<thead>
												<tr>
													<th>#</th>
													<th>Category Name</th>
													<th>Slug</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($all_data as $data)
												<tr>
													<td>{{ $loop -> index + 1 }}</td>
													<td>{{ $data -> name }}</td>
													<td>{{ $data -> slug }}</td>
													<td>
														@if($data -> status == 'published')
															<span class="badge badge-success">Published</span>
															@else
															<span class="badge badge-danger">Unpublished</span>
														@endif
													</td>
													<td>
														@if($data -> status == 'published')
															<a class="btn btn-sm btn-danger" href="{{ route('category.unpublished', $data -> id) }}"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
														@else
															<a class="btn btn-sm btn-success" href="{{ route('category.Published', $data -> id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
														@endif
															<a id="category_edit" data-toggle="modal" edit_id="{{ $data -> id }}" class="btn btn-warning btn-sm" href="#category_modal_Update">Edit</a>
														<form style="display:inline;" action="{{ route('post-category.destroy', $data -> id) }}" method="POST">
															@csrf
															@method('DELETE')
															<button class="btn btn-sm btn-danger">Delete</button>
														</form>
													</td>
												</tr>
                                       @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                    </div>

                    {{-- add category modal --}}
					<div id="category_modal" class="modal fade">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content bg-success">
								<div class="modal-header">
									<h4 class="modal-title">Add new Categorys</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('post-category.store') }}" method="POST">
                               @csrf
										<div class="form-group">
											<input name="name" class="form-control" type="text" placeholder="Name">
										</div>
										<div class="form-group">
											<input class="btn btn-block btn-info"  type="submit" value="add">
										</div>
									</form>
								</div>
							</div>
						</div>
                    </div>

                    {{-- category update modal --}}
					<div id="category_modal_Update" class="modal fade">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content bg-warning">
								<div class="modal-header">
									<h4 class="modal-title">Update Category</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('category.update') }}" method="POST">
                                         @csrf
										<div class="form-group">
											<input name="name" class="form-control" type="text" placeholder="name">
											<input name="id" class="form-control" type="hidden" placeholder="name">
										</div>
										<div class="form-group">
											<input class="btn btn-block btn-info"  type="submit" value="Update">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
			<!-- /Page Wrapper -->

@endsection
