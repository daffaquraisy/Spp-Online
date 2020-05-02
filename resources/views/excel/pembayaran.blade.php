
                <table >
                    <thead>
                      <tr>
                        <th><b>No</b></th>
                        <th><b>Nama</b></th>
                        <th><b>NISN</b></th>
                        <th><b>Waktu Pemnayaran</b></th>
                        <th><b>Jumlah</b></th>
                        <th><b>Status</b></th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($orders as $o)
                    <tr>
                        <td>{{$nomor++}}</td>
                        <td>{{$o->students->nama}}</td>
                        <td>{{$o->students->nisn}}</td>
                        <td>{{$o->waktu_pembayaran}}</td>
                        <td>{{$o->amount}}</td>
                        <td>{{$o->status}}</td>
                    </tr>    
                    @endforeach
                    
                      
                    </tbody>
                  </table>