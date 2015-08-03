
                <!-- content wrapper -->
                <div class="content-wrap">

                    <!-- inner content wrapper -->
                    <div class="wrapper">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h5>Data Tables</h5>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive no-border">
                                    <table id="sampleTable" class="table table-bordered table-striped mg-t datatable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start Date</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /inner content wrapper -->

                </div>
                <!-- /content wrapper -->
				
				<script>
				$(document).ready(function(){
					$('#sampleTable').dataTable();
				});
				</script>
                