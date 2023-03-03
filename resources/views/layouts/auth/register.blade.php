
<div class="modal fade" id="RegisterModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark text-light border-bottom-0 border-left-0 border-right-0 border-top border-warning border-4">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Registration (STEP 1) : Email Varification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form   id="registerForm" action="{{ route('send_link.email') }}" class="formContainer">
        @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <div class="spinner-border text-primary d-none" role="status" id="spinner">
            <span class="sr-only">Sending...</span>
        </div>
          <button id="submitBtn" type="submit" class="btn btn-warning">Send Registration Link</button>
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
                        $("#registerForm").trigger("reset");
                        $("#RegisterModal").modal('hide');
                        // setTimeout(() => {
                        //     closeRegisterForm();
                        // }, 3000);
                        // location.reload();
                    } else {
                       toastr.error(data.message);
                        // $('#spinner').hide();
                        $('#submitBtn').html('Send Registration Link');
                        $('#submitBtn').attr('disabled', false);
                    }
                },
                error: function(data) {
                    toastr.error(data.message);
                        // $('#spinner').hide();
                        $('#submitBtn').html('Send Registration Link');
                        $('#submitBtn').attr('disabled', false);
                }
            });
        });
    </script>
  </div>
