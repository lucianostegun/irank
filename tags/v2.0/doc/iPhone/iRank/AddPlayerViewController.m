//
//  AddPlayerViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "AddPlayerViewController.h"
#import "iRankAppDelegate.h"
#import "Player.h"
#import "EventPlayer.h"
#import "RankingPlayer.h"
#import "RankingPlayerViewController.h"
#import "EventPlayerViewController.h"
#import "JSON.h"

@implementation AddPlayerViewController
@synthesize labels, placeholders;
@synthesize rankingId;
@synthesize eventId;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {

        self.labels = [NSArray arrayWithObjects:@"Nome", 
                       @"Sobrenome", 
                       @"E-mail",
                       nil];
        
        self.placeholders = [NSArray arrayWithObjects:@"obrigatório", 
                             @"opcional", 
                             @"obrigatório",
                             nil];
        
        firstName    = @"";
        lastName     = @"";
        emailAddress = @"";
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

    UIBarButtonItem *saveButton = [[UIBarButtonItem alloc] initWithTitle:@"salvar" style:UIBarButtonItemStyleDone target:self action:@selector(savePlayer:)];
    
    self.navigationItem.rightBarButtonItem = saveButton;
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
}

-(void)savePlayer:(id)sender {
    
    [self.view endEditing:YES];
    
    if( [firstName isEqualToString:@""] || [emailAddress isEqualToString:@""] ){
        
        return [appDelegate showAlert:@"Erro" message:@"Favor preencher todos os campos."];   
    }
    
    NSString *emailRegex = @"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}";
    NSPredicate *emailTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", emailRegex];
    
    if( ![emailTest evaluateWithObject:emailAddress] )
        return [appDelegate showAlert:@"Erro" message:@"O e-mail informado não é válido."];
    
    [appDelegate showLoadingView:@"adicionando novo jogador..."];
    [self performSelector:@selector(doSavePlayer) withObject:nil afterDelay:0.1];
}

-(void)doSavePlayer {
    
    NSString *stringData = [NSString stringWithFormat:@"<?xml version=\"1.0\"?>\n<players>"];
    stringData = [stringData stringByAppendingFormat:@"\n\t<player>"];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<firstName>%@</firstName>", firstName];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<lastName>%@</lastName>", lastName];
    stringData = [stringData stringByAppendingFormat:@"\n\t\t<emailAddress>%@</emailAddress>", emailAddress];
    stringData = [stringData stringByAppendingString:@"\n\t</player>"];
    stringData = [stringData stringByAppendingString:@"\n</players>"];
    
    NSLog(@"stringData: %@", stringData);
    
    const char *bytes = [[NSString stringWithFormat:@"playerXml=%@", stringData] UTF8String];
    
    NSURL *url                   = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/ranking/savePlayer/rankingId/%i/eventId/%i", serverAddress, rankingId, eventId]];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:241];
	NSError *requestError = nil;
    
    [request setHTTPMethod:@"POST"];
    [request setHTTPBody:[NSData dataWithBytes:bytes length:strlen(bytes)]];
	NSData *response = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError]; 
    
    if(requestError == nil) {
        
        NSString *result = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
        NSLog(@"result: %@", result);
        [appDelegate hideLoadingView];
        
        SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
        NSDictionary *jsonObjects = [jsonParser objectWithString:result error:nil];
        
        NSString *saveStatus = [jsonObjects objectForKey:@"saveStatus"];
        
        if( [saveStatus isEqualToString:@"saveSuccess"] || [saveStatus isEqualToString:@"playerExists"] ){
            
            UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Sucesso" message:@"O novo jogador foi incluído ao ranking.\nDeseja incluir um novo jogador?" delegate:self cancelButtonTitle:@"Não" otherButtonTitles:@"Sim", nil];
            
            int playerId = [[jsonObjects objectForKey:@"id"] intValue];
            
            firstName = [jsonObjects objectForKey:@"firstName"];
            lastName  = [jsonObjects objectForKey:@"lastName"];
            
            if( eventId ){
                
                EventPlayerViewController *eventPlayerViewController = [self.navigationController.viewControllers objectAtIndex:[self.navigationController.viewControllers count]-2];
                [[eventPlayerViewController event] addPlayer:playerId firstName:firstName lastName:lastName emailAddress:emailAddress];
                [[eventPlayerViewController tableView] reloadData];
            }else{

                RankingPlayerViewController *rankingPlayerViewController = [self.navigationController.viewControllers objectAtIndex:[self.navigationController.viewControllers count]-2];
                [[rankingPlayerViewController ranking] addPlayer:playerId firstName:firstName lastName:lastName emailAddress:emailAddress];
                rankingPlayerViewController.rankingPlayerList = rankingPlayerViewController.ranking.rankingPlayerList;
                [[rankingPlayerViewController tableView] reloadData];
            }
            
            [alert show];
            [alert release];

        }else if( [result length] < 100 )
            [appDelegate showAlert:@"Erro" message:result];
        
//        jsonObjects = nil;
//        jsonParser = nil;
//        [saveStatus release];
	} else {
        
        NSLog(@"Passou por aqui porque deu erro");
        [appDelegate hideLoadingView];
        [appDelegate showAlert:@"Falha" message:@"Não foi possível salvar o jogador.\nPor favor, tente novamente."];
	}
}

- (void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex {
    
    if( buttonIndex==0 ){
        
        [self.navigationController popToViewController: [self.navigationController.viewControllers objectAtIndex:[self.navigationController.viewControllers count]-2] animated:YES];
    }else{
        
        firstName    = @"";
        lastName     = @"";
        emailAddress = @"";
        [[self tableView] reloadData];
    }
        
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
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
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
    
    return 3;
}

- (void)configureCell:(ELCTextfieldCell *)cell atIndexPath:(NSIndexPath *)indexPath {
	
	cell.leftLabel.text = [self.labels objectAtIndex:indexPath.row];
	cell.rightTextField.placeholder = [self.placeholders objectAtIndex:indexPath.row];
	cell.indexPath = indexPath;
	cell.delegate = self;
    //Disables UITableViewCell from accidentally becoming selected.
    cell.selectionStyle = UITableViewCellSelectionStyleNone;
    
    if(indexPath.row == 2)
		[cell.rightTextField setKeyboardType:UIKeyboardTypeEmailAddress];
    
    if( indexPath.row==2 )
        [cell.rightTextField setReturnKeyType:UIReturnKeyDone];
    else
        [cell.rightTextField setReturnKeyType:UIReturnKeyNext];
    
    if( indexPath.row < 2 )
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeWords];
    else
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeNone];
    
    cell.rightTextField.tag = indexPath.row;
    
    switch ( indexPath.row ) {
        case 0:
            cell.rightTextField.text = firstName;
            break;
        case 1:
            cell.rightTextField.text = lastName;
            break;
        case 2:
            cell.rightTextField.text = emailAddress;
            break;
    }
    
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
            firstName = [string copy];
            break;
        case 1:
            lastName = [string copy];
            break;
        case 2:
            emailAddress = [string copy];
            break;
    }
}

-(BOOL)textField:(UITextField *)textField shouldChangeCharactersInRange:(NSRange)range replacementString:(NSString *)string {
    
    switch (textField.tag) {
        case 0:
            return [textField.text length] <= 25;
            break;
        case 1:
            return [textField.text length] <= 25;
            break;
        case 2:
            return [textField.text length] <= 150;
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

@end
