@if(session('success'))
	<x-flowcms-alert variant="success">{{ session('success') }}</x-flowcms-alert>
@endif

@if(session('error'))
	<x-flowcms-alert variant="error">{{ session('error') }}</x-flowcms-alert>
@endif

@if(session('info'))
	<x-flowcms-alert variant="info">{{ session('info') }}</x-flowcms-alert>
@endif
