
  <div class="modal fade" id="LoginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content bg-dark text-light border-bottom-0 border-left-0 border-right-0 border-top border-warning border-4">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">LOGIN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('login') }}" method="POST">
          @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-warning">LOGIN</button>
        </div>
        </form>
      </div>
    </div>
    <script>
        // registerForm submit
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(this);
           // console.log(formData);
            // $('#spinner').show();
            $('#submitBtn').html('Sending...');
            $('#submitBtn').attr('disabled', true);

            $.ajax({
                type: "POST",
                url: url,
                _token: '{{ csrf_token() }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'success') {
                        // $('#spinner').hide();
                        toastr.success(data.message);
                        $('#RegisterModal').modal('hide');
                        $('#LoginModal').modal('show');
                    } else {
                        // $('#spinner').hide();
                        $('#submitBtn').html('Send Registration Link');
                        $('#submitBtn').attr('disabled', false);
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    // $('#spinner').hide();
                    $('#submitBtn').html('Send Registration Link');
                    $('#submitBtn').attr('disabled', false);
                    toastr.error(data.message);
                }
            });
        });
    </script>
  </div>
