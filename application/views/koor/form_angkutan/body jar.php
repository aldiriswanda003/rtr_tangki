<tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($angkutan as $st) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $st->nopol ?></td>
                                            <td><?= $st->volume_tangki ?></td>
                                            <td><?= $st->nama_supir ?></td>
                                            <td><?= $st->tgl_berangkat ?></td>
                                            <td><?= $st->nama_tujuan ?></td>
                                            <td><?= $st->kilometer_pp ?> KM</td>



                                            <td><a href="<?= base_url('admin/edit_angkutan/' . $st->id_angkutan); ?>" type="button" class="btn btn-xs btn-success " name="btn_edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                            <a href="<?= base_url('admin/hapus_angkutan/' . $st->id_angkutan); ?>" type="button" class="btn btn-xs btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>