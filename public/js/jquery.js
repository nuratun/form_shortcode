(function( $ ) {
	 $( window ).load( function() {
		 // Check if the submit button has been clicked
		 $( '#submit' ).on( 'click', function( e ) {
			 e.preventDefault(); // Necessary to prevent reloading

       // Get the post data
       let subject = $("#subject").val();
       let msg = $("#message").val();
       let nonce = $("#custom_nonce").val();

			 $.ajax({
				 url: ajaxcall.ajax_url, // This is registered through wp_localize_script in the public class
				 type: 'post',
				 data: {
					 action: 'submit_form', // The function to submit the data to
					 subject: subject,
           message: msg,
           custom_nonce: nonce
				 },
				 success: function( response ) {
           $( ".form-response" ).append( "<p>Success!</p>" );
           $( ".form-class" ).hide();
				 },
				 error: function( err ) {
					 console.log( err );
				 }
			 });
		 });
	 });
})( jQuery );
