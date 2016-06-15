package bcaapps;

public class User {
	protected Integer usrId= null;
	protected String usrFirstName = "";
	protected String usrLastName = "";
	protected String usrDisplayName = "";
	protected String usrBcaId  = "";
	protected String usrEmail  = "";
	protected String usrTypeCde  = "";
	protected Integer usrClassYear = null;
	protected String academyCde  = "";
	protected String psId  = "";
	protected Integer usrActive = null;
	protected String usrAdCn = "";
	
	public User()
	{}
	
	public User(Integer usrId, String usrFirstName, String usrLastName, String usrDisplayName, 
			String usrBcaId, String usrEmail, String usrTypeCde, Integer usrClassYear, String academyCde, String psId,
			Integer usrActive, String usrAdCn) {
		super();
		this.usrId = usrId;
		this.usrFirstName = usrFirstName;
		this.usrLastName = usrLastName;
		this.usrDisplayName = usrDisplayName;
		this.usrBcaId = usrBcaId;
		this.usrEmail = usrEmail;
		this.usrTypeCde = usrTypeCde;
		this.usrClassYear = usrClassYear;
		this.academyCde = academyCde;
		this.psId = psId;
		this.usrActive = usrActive;
		this.usrAdCn = usrAdCn;
	}
	
	public Integer getUsrId() {
		return usrId;
	}
	public void setUsrId(Integer usrId) {
		this.usrId = usrId;
	}
	public String getUsrFirstName() {
		return usrFirstName;
	}
	public void setUsrFirstName(String usrFirstName) {
		this.usrFirstName = usrFirstName;
	}
	public String getUsrLastName() {
		return usrLastName;
	}
	public void setUsrLastName(String usrLastName) {
		this.usrLastName = usrLastName;
	}
	public String getUsrDisplayName() {
		return usrDisplayName;
	}
	public void setUsrDisplayName(String usrDisplayName) {
		this.usrDisplayName = usrDisplayName;
	}
	public String getUsrBcaId() {
		return usrBcaId;
	}
	public void setUsrBcaId(String usrBcaId) {
		this.usrBcaId = usrBcaId;
	}
	public String getUsrEmail() {
		return usrEmail;
	}
	public void setUsrEmail(String usrEmail) {
		this.usrEmail = usrEmail;
	}
	public String getUsrTypeCde() {
		return usrTypeCde;
	}
	public void setUsrTypeCde(String usrTypeCde) {
		this.usrTypeCde = usrTypeCde;
	}
	public Integer getUsrClassYear() {
		return usrClassYear;
	}
	public void setUsrClassYear(Integer usrClassYear) {
		this.usrClassYear = usrClassYear;
	}
	public String getAcademyCde() {
		return academyCde;
	}
	public void setAcademyCde(String academyCde) {
		this.academyCde = academyCde;
	}
	public String getPsId() {
		return psId;
	}
	public void setPsId(String psId) {
		this.psId = psId;
	}
	public Integer getUsrActive() {
		return usrActive;
	}
	public void setUsrActive(Integer usrActive) {
		this.usrActive = usrActive;
	}
	public String getUsrAdCn() {
		return usrAdCn;
	}
	public void setUsrAdCn(String usrAdCn) {
		this.usrAdCn = usrAdCn;
	}

	@Override
	public String toString() {
		return "User [usrId=" + usrId + ", usrFirstName=" + usrFirstName + ", usrLastName=" + usrLastName
				+ ", usrDisplayName=" + usrDisplayName + ", usrBcaId=" + usrBcaId + ", usrEmail=" + usrEmail
				+ ", usrTypeCde=" + usrTypeCde + ", usrClassYear=" + usrClassYear + ", academyCde=" + academyCde
				+ ", psId=" + psId + ", usrActive=" + usrActive + ", usrAdCn=" + usrAdCn + "]";
	}
	
}
