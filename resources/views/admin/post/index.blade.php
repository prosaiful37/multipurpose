@extends('layouts.app');

@section('main-content')
			<!-- Page Wrapper -->
            <div class="page-wrapper">

                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome {{  Auth::user() -> name  }}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">POST</li>
								</ul>
							</div>
						</div>
					</div>
                    <!-- /Page Header -->

               <div class="row">
                     <div class="col-md-12">
                            @include('validate')
							<a class="btn btn-success" data-toggle="modal" href="#post_modal">Add new Post</a>
							<br>
							<br>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Post</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0 post-table ">
											<thead>
												<tr>
													<th>#</th>
													<th>Title</th>
													<th>category</th>
													<th>tags</th>
													<th>featured image</th>
													<th>Time</th>
													<th>status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($all_data as $data)
												<tr>
													<td>{{ $loop -> index + 1 }}</td>
													<td>{{ $data -> title }}</td>
													<td>
                                                        @foreach ($data -> categories as $category )
                                                            {{ $category -> name }} |
                                                        @endforeach
                                                    </td>
													<td>{{ $data -> tag }}</td>
													<td>
														@if(!empty($data -> featured_image))
															<img style="width:60px; height:60px;" src="{{ URL::to('/') }}/media/posts/{{ $data -> featured_image }}" alt=""></td>
														@endif
                                                    </td>
                                                    <td>{{ $data -> created_at ->diffForHumans() }}</td>
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
															<a id="post_edit" data-toggle="modal" edit_id="{{ $data -> id }}" class="btn btn-warning btn-sm" href="#post_modal_Update">Edit</a>
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

                    {{-- add post modal --}}
					<div id="post_modal" class="modal fade">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content bg-light">
								<div class="modal-header">
									<h4 class="modal-title">Add new post</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
										 <div class="form-group">
											 <input name="title" class="form-control" type="text" placeholder="title">
										 </div>
										 <div class="form-group">
                                            <label for="">category</label>
                                            <hr>
                                            @foreach($categories as $category)
                                                <div class="checkbox"> 
                                                    <label>
                                                        <input type="checkbox" value="{{ $category -> id }}" name="category[]"> {{ $category -> name }}
                                                    </label>
                                                </div>
                                            @endforeach
										 </div>
										<div class="form-group">
                                            <label style="font-size:70px; coursor:pointer;" for="fimage"><i class="fa fa-file-image-o" aria-hidden="true"></i></label>
											<input style="display:none;" name="fimg" class="form-control" type="file" id="fimage">
                                            <img style="max-width: 100%; display:block;" id="post_featured_image" src="" alt="">
										</div>
										<div class="form-group">
											<textarea id="post_editor" name="content"></textarea>
										</div>
										<div class="form-group">
											<input class="btn btn-block btn-info"  type="submit" value="add">
										</div>
									</form>
								</div>
							</div>
						</div>
                    </div>

                    {{-- post update modal --}}
					<div id="post_modal_Update" class="modal fade">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content bg-warning">
								<div class="modal-header">
									<h4 class="modal-title">Update post</h4>
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
