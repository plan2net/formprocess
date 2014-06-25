mod.wizards {
    form {
		defaults {
			tabs {
				form {
					accordions {
						postProcessor {
							showPostProcessors := addToList(user)
							postProcessors {
								user {
									showProperties = userFunction
								}
							}
						}
					}
				}
			}
		}
	}
}