$.validate({
	modules : 'security',
	onModulesLoaded : function() {
		var optionalConfig = {
			fontSize : '12pt',
			padding : '4px',
			bad : 'Muy Debil',
			weak : 'Debil',
			good : 'Fuerte',
			strong : 'Muy Fuerte'
		};

		$('input[name="newPassword"]').displayPasswordStrength(optionalConfig);
	}
});