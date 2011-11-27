//
//  SignViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "SignViewController.h"
#import "iRankAppDelegate.h"
#import "Constants.h"

@implementation SignViewController
@synthesize labels;
@synthesize placeholders;
@synthesize tempValues;
@synthesize username, password;
@synthesize signSuccess;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];

    self.labels = [NSArray arrayWithObjects:@"Username", 
                   @"E-mail", 
                   @"Nome", 
                   @"Sobrenome", 
                   @"Senha", 
                   @"Confirmação", 
                   nil];
	
	self.placeholders = [NSArray arrayWithObjects:@"obrigatório", 
                         @"obrigatório", 
                         @"obrigatório", 
                         @"opcional",  
                         @"obrigatório",   
                         @"obrigatório", 
                         nil];
    
    username = @"lstegun";
    emailAddress = @"lucianostegun@gmail.com";
    firstName = @"Luciano";
    lastName = @"Stegun";
    password = @"unidunite";
    passwordConfirm = @"unidunite";
	
	self.tempValues = [NSArray arrayWithObjects:username, emailAddress, firstName, lastName, password, passwordConfirm, nil];
    
    self.navigationController.navigationBar.tintColor = [UIColor blackColor];
    
    UIBarButtonItem *saveButton = [[UIBarButtonItem alloc] initWithTitle:@"salvar" style:UIBarButtonItemStyleDone target:self action:@selector(saveSign:)];

    self.navigationItem.rightBarButtonItem = saveButton;
}

-(void)saveSign:(id)sender {
    
    [self.view endEditing:YES];
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    if( [username isEqualToString:@""] || [emailAddress isEqualToString:@""] || [firstName isEqualToString:@""] ||
       [password isEqualToString:@""] || [passwordConfirm isEqualToString:@""] ){
        
        return [appDelegate showAlert:@"Erro" message:@"Favor preencher todos os campos."];   
    }
    
    if( [password length] < 6 )
        return [appDelegate showAlert:@"Erro" message:@"A senha deve possuir no mínimo 6 caracteres."];
    
    if( ![password isEqualToString:passwordConfirm] )
        return [appDelegate showAlert:@"Erro" message:@"A senha deve ser igual a confirmação."];
    

    NSString *usernameRegex = @"^[a-zA-Z]+[a-zA-Z0-9_-]*$";
    NSPredicate *usernameTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", usernameRegex];
    
    if( ![usernameTest evaluateWithObject:username] )
        return [appDelegate showAlert:@"Erro" message:@"O nome de usuário escolhido não é válido."];
    
    NSString *emailRegex = @"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}";
    NSPredicate *emailTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", emailRegex];
    
    if( ![emailTest evaluateWithObject:emailAddress] )
        return [appDelegate showAlert:@"Erro" message:@"O e-mail informado não é válido."];
    
    [appDelegate showLoadingView:@"criando novo cadastro..."];
    [self performSelector:@selector(doSaveSign) withObject:nil afterDelay:0.1];
}

-(void)doSaveSign {
    
    NSString *stringData = [NSString stringWithFormat:@"<?xml version=\"1.0\"?>\n<userSites>"];
    stringData = [stringData stringByAppendingFormat:@"\n\t<userSite>", username];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<username>%@</username>", username];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<emailAddress>%@</emailAddress>", emailAddress];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<firstName>%@</firstName>", firstName];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<lastName>%@</lastName>", lastName];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<password>%@</password>", password];
    stringData = [stringData stringByAppendingString:@"\n\t</userSite>"];
    stringData = [stringData stringByAppendingString:@"\n</userSites>"];
    
    //        NSLog(@"stringData: %@", stringData);
    
    const char *bytes = [[NSString stringWithFormat:@"userSiteXml=%@", stringData] UTF8String];
    
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/login/save", serverAddress]];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:240];
	NSError *requestError = nil;
    
    [request setHTTPMethod:@"POST"];
    [request setHTTPBody:[NSData dataWithBytes:bytes length:strlen(bytes)]];
	NSData *response = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError]; 
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    if(requestError == nil) {

        NSString *result = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
        
        NSLog(@"result: %@", result);
        [appDelegate hideLoadingView];
        
        if( [result isEqualToString:@"saveSuccess"] ){

//            [appDelegate showAlert:@"Sucesso" message:@"Cadastro concluído com sucesso.\nSeja bem-vindo ao iRank!"];
            UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Sucesso" message:@"Cadastro concluído com sucesso.\nSeja bem-vindo ao iRank!" delegate:self cancelButtonTitle:nil otherButtonTitles:@"Ok", nil];

            [alert show];
            [alert release];
            
            signSuccess = YES;
        }else if( [result length] < 100 )
            [appDelegate showAlert:@"Erro" message:result];
	} else {
        
        NSLog(@"Passou por aqui porque deu erro");
        [appDelegate hideLoadingView];
        [appDelegate showAlert:@"Falha" message:@"Não foi possível concluir seu cadastro.\nPor favor, tente novamente."];
	}
}

- (void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex{

    [self.navigationController popToViewController: [self.navigationController.viewControllers objectAtIndex:0] animated:YES];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];   
    [self.navigationController setNavigationBarHidden:NO animated:YES];
    
    self.title = @"Cadastro";
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
    signSuccess = NO;
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
    [self.navigationController setNavigationBarHidden:YES animated:YES];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    return 6;
}

- (void)configureCell:(ELCTextfieldCell *)cell atIndexPath:(NSIndexPath *)indexPath {
	
	cell.leftLabel.text = [self.labels objectAtIndex:indexPath.row];
	cell.rightTextField.placeholder = [self.placeholders objectAtIndex:indexPath.row];
	cell.indexPath = indexPath;
	cell.delegate = self;
    //Disables UITableViewCell from accidentally becoming selected.
    cell.selectionStyle = UITableViewCellSelectionStyleNone;
    
    if(indexPath.row == 1)        
		[cell.rightTextField setKeyboardType:UIKeyboardTypeEmailAddress];
	if(indexPath.row >= 4)        
		[cell.rightTextField setSecureTextEntry:YES];
    
    if( indexPath.row==5 )
        [cell.rightTextField setReturnKeyType:UIReturnKeyDone];
    else
        [cell.rightTextField setReturnKeyType:UIReturnKeyNext];
    
    if( indexPath.row==2 || indexPath.row==3 )
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeWords];
    else
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeNone];
    
    cell.rightTextField.tag = indexPath.row;
    
    cell.rightTextField.text = [self.tempValues objectAtIndex:indexPath.row];
    
    [cell.rightTextField setClearButtonMode:UITextFieldViewModeWhileEditing];
    
    [cell.rightTextField setAutocorrectionType:UITextAutocorrectionTypeNo];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    static NSString *CellIdentifier = @"Cell";
    
    ELCTextfieldCell *cell = (ELCTextfieldCell*)[tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[ELCTextfieldCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
	
	[self configureCell:cell atIndexPath:indexPath];
    
    return cell;
}

-(void)textFieldDidReturnWithIndexPath:(NSIndexPath*)indexPath {
    
    NSIndexPath *path = [NSIndexPath indexPathForRow:indexPath.row+1 inSection:indexPath.section];
    
    UITextField *theTextField = [(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:path] rightTextField];
    
	if(indexPath.row < [labels count]-1) {

		
		[theTextField becomeFirstResponder];
		[self.tableView scrollToRowAtIndexPath:path atScrollPosition:UITableViewScrollPositionTop animated:YES];
	}else{
        
		[[(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:indexPath] rightTextField] resignFirstResponder];
	}
}

-(void)updateTextLabelAtIndexPath:(NSIndexPath*)indexPath string:(NSString*)string {
    
    switch (indexPath.row) {
        case 0:
            username = [string copy];
            break;
        case 1:
            emailAddress = [string copy];
            break;
        case 2:
            firstName = [string copy];
            break;
        case 3:
            lastName = [string copy];
            break;
        case 4:
            password = [string copy];
            break;
        case 5:
            passwordConfirm = [string copy];
            break;
    }
}

-(BOOL)textField:(UITextField *)textField shouldChangeCharactersInRange:(NSRange)range replacementString:(NSString *)string {
    
    switch (textField.tag) {
        case 0:
            return [textField.text length] <= 15;
            break;
        case 1:
            return [textField.text length] <= 150;
            break;
        case 2:
            return [textField.text length] <= 25;
            break;
        case 3:
            return [textField.text length] <= 25;
            break;
        case 4:
            return [textField.text length] <= 32;
            break;
        case 5:
            return [textField.text length] <= 32;
            break;
    }
    
    return NO;
}

/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

-(void)dealloc {
    
    [username release];
    [password release];
    [super dealloc];
}

@end
