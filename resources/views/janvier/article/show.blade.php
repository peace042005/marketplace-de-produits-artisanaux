<table class="table table-bordered table-striped mb-0" id="datatable-editable">
									<thead>
										<tr>
											<th>Nom du type </th>
											<th>Prix</th>
											<th>Durer</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($type_abonnements as $type_abonnement)
										<tr >
											<td>{{$type_abonnement->type}}</td>
											<td>{{$type_abonnement->prix}}</td>
											<td>{{$type_abonnement->duree}}</td>
											<td class="actions">
												<a href="#" class="hidden on-editing save-row"><i class="fas fa-save"></i></a>
												<a href="#" class="hidden on-editing cancel-row"><i class="fas fa-times"></i></a>
												
													@csrf
													@method("DELETE")
												<button  type="submit" class="on-default remove-row modal-basic" 
												data-bs-toggle="modal" data-bs-target="#modalConfirm"  data-id="{{ $type_abonnement->id }}">
													<i class="far fa-trash-alt"></i>
												</button>
												
											</td>
										</tr>
										@endforeach
									
										
									</tbody>
								</table>