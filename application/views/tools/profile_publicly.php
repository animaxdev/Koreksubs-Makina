
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-<?= $theme['accent_color'] ?> card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <div class="img-circle img-bordered mr-auto ml-auto" style="background: url('<?= base_url(); ?>assets/img/<?php 
                  $user_id = $this->session->userdata("user_id");
                  echo $userdata['photo'];
                ?>') center; width: 180px; height: 180px; background-size: cover;">
                  </div>
                </div>

                <h3 class="profile-username text-center"><?php echo $userdata['username'] ?></h3>

                <p class="text-muted text-center">Nomor ID: <?php echo $userdata['user_id'] ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Komentar</b> <a class="float-right"><?php echo $comment_count ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-<?= $theme['accent_color'] ?>">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-users mr-1"></i> Member Sejak</strong>

                <p class="text-muted">
                    <?php 
                        $this->load->model('Client_model');
                        echo $this->Client_model->get_time_ago($userdata['timestamp']);
                     ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

                <p class="text-muted"><?php echo $userdata['kota_asal'] ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?php echo $userdata['skills'] ?></span>
                </p>

                <hr>

                <strong><i class="fas fa-flask mr-1"></i> Tema yang digunakan</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?php echo $userdata['theme'] ?></span>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active ml-2 bg-<?= $theme['accent_color'] ?>" href="#timeline" data-toggle="tab">Timeline Komentar</a></li>
                  <li class="nav-item"><a href="<?php echo base_url('client/message_compose.asp?reply_to=') ?><?php echo $userdata['username'] ?>" type="button" class="nav-link active ml-2 bg-<?= $theme['accent_color'] ?>"><i class="fas fa-envelope"></i> Kirim Pesan ke <?php echo $userdata['username'] ?></a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="container">
                  <?php if ( !empty($this->session->flashdata('error')) ): ?>
                    <?php if ( strlen(str_replace( 'Anda tidak memilih berkas untuk mengunggah.', '', $this->session->flashdata('error') )) > 8 ): ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo($this->session->flashdata('error')) ?>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="timeline">
                    <?php 
                        $bulan0 = '';
                        $tahun0 = '';
                    ?>

                      <div class="timeline timeline-inverse">
                    <!-- The timeline -->
                    <?php if ($comment_count == 0): ?>

                       <!-- timeline item -->
                       <div>
                         <i class="fas fa-comments bg-info"></i>

                         <div class="timeline-item">

                           <h3 class="timeline-header border-0">Belum ada komentar</a>
                           </h3>
                         </div>
                       </div>
                       <!-- END timeline item -->
                    <?php else: ?>
                        <?php foreach ($user_comments as $key => $value): ?>
                        <?php 
                          $tanggal = $this->Client_model->convertTimeFormat($value['timestamp']);
                          $tanggal_temp = explode(',', $tanggal);
                          $tanggal_depan = explode(' ', $tanggal_temp[0]);
                          $tanggal_belakang = explode(' ', $tanggal_temp[1]);
                          $bulan = $tanggal_depan[1];
                          $tahun = $tanggal_depan[2];
                        ?>
                        <?php if ( $bulan0 != $bulan or $tahun0 != $tahun ): ?>
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-danger">
                            <?php echo $bulan.' '.$tahun ?>
                          </span>
                        </div>
                        <?php 
                        $bulan0 = $bulan; 
                        $tahun0 = $tahun; //Updating the value
                        ?>
                        <!-- /.timeline-label -->
                        <?php endif ?>
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-comments bg-info"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> <?php 
                          echo $this->Client_model->get_time_ago($value['timestamp']);
                       ?></span>

                            <h3 class="timeline-header border-0">Berkomentar di <a href="<?php echo base_url('client/anime/'.$value['anime_parent_id']) ?>"><?php $judul = $this->Client_model->getAnimeNameById($value['anime_parent_id']);
                                if ($judul == false) {
                                    echo "<i> maaf data telah dihapus.</i>";
                                }else{
                                    echo $judul;
                                }
                             ?></a>
                            </h3>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <?php endforeach ?>                      
                    <?php endif ?>
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>