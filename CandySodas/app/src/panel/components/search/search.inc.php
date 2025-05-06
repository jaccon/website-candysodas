<div class="card-body pt-0">
    <div id="kt_ecommerce_products_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
        <div id="" class="table-responsive">
          <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable" id="kt_ecommerce_products_table">
              
              <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0" role="row">
                    <th class="min-w-200px dt-orderable-asc dt-orderable-desc" data-dt-column="1" rowspan="1" colspan="1" aria-label="Product: Activate to sort" tabindex="0">
                      <span class="dt-column-title" role="button">Title</span><span class="dt-column-order"></span>
                    </th>
                    <th class="text-end min-w-100px dt-type-numeric dt-orderable-asc dt-orderable-desc" data-dt-column="2" rowspan="1" colspan="1" aria-label="SKU: Activate to sort" tabindex="0">
                      <span class="dt-column-title" role="button">ID</span><span class="dt-column-order"></span>
                    </th>
                    <th class="text-end min-w-70px dt-type-numeric dt-orderable-asc dt-orderable-desc" data-dt-column="3" rowspan="1" colspan="1" aria-label="Qty: Activate to sort" tabindex="0">
                      <span class="dt-column-title" role="button">CreatedAt</span><span class="dt-column-order"></span>
                    </th>
                    <th class="text-end min-w-100px dt-orderable-asc dt-orderable-desc" data-dt-column="6" rowspan="1" colspan="1" aria-label="Status: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Status</span><span class="dt-column-order"></span></th>
                    <th class="text-end min-w-70px dt-orderable-none" data-dt-column="7" rowspan="1" colspan="1" aria-label="Actions"><span class="dt-column-title">Actions</span><span class="dt-column-order"></span></th>
                </tr>
              </thead>
              <tbody class="fw-semibold text-gray-600">
                <tr>
                    <td>
                      <div class="d-flex align-items-center">
                          <div class="ms-5">
                            <a href="edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">
                              Product 1
                            </a>
                          </div>
                      </div>
                    </td>
                    <td class="text-end pe-0 dt-type-numeric">
                      <span class="fw-bold">04601005</span>
                    </td>
                    <td class="text-end pe-0 dt-type-numeric" data-order="15">
                      <span class="fw-bold ms-3">15</span>
                    </td>
                    <td class="text-end pe-0 dt-type-numeric">222.00</td>
                    <td class="text-end">

                        <a href="post-update.html?id=<?= $item['id']; ?>" alt="Edit data" title="Edit data"> 
                            <i class="ki-duotone ki-pencil">
                              <span class="path1"></span>
                              <span class="path2"></span>
                            </i>
                        </a> 
                        &nbsp;
                        <a 
                          title="Delete data" 
                          class="delete-button" 
                          data-id="<?= $item['id']; ?>" 
                          href="#"
                          onclick="confirmDelete('<?= $item['id']; ?>')">
                            <i class="ki-duotone ki-cross-circle">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
             
                    </td>
                </tr>
              </tbody>
              <tfoot>
              </tfoot>
          </table>
        </div>
       <!--  -->

    </div>
</div>